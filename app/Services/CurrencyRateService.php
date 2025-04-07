<?php

namespace App\Services;

use App\Enums\Currency;
use App\Models\CurrencyRate;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyRateService
{
    /**
     * @const ALLOWED_CURRENCIES
     */
    private const ALLOWED_CURRENCIES = ['USD', 'RUB', 'EUR'];

    /**
     * @return void
     *
     * @throws ConnectionException
     * @throws Exception
     */
    public function updateRates(): void
    {
        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->get(env('RATES_URL'));

            if ($response->failed()) {
                throw new ConnectionException('Request failed with status: ' . $response->status());
            }

            $xml = simplexml_load_string($response->body());

            if ($xml === false) {
                throw new Exception('Invalid XML response');
            }

            $rates = json_decode(json_encode($xml), true);

            if (empty($rates)) {
                Log::warning('API returned empty rates.', ['response' => $rates]);
                return;
            }

            if (isset($rates['filials']['filial'])) {
                foreach ($rates['filials']['filial'] as $filial) {
                    foreach ($filial['rates']['value'] as $value) {
                        $currencyCode = (string)$value['@attributes']['iso'];

                        if (in_array($currencyCode, self::ALLOWED_CURRENCIES)) {
                            $rate = (float)$value['@attributes']['sale'];

                            if (is_numeric($rate)) {
                                CurrencyRate::query()->updateOrCreate(
                                    ['currency' => $currencyCode],
                                    ['rate' => $rate],
                                );
                            } else {
                                Log::error("Invalid rate value for currency $currencyCode: $rate");
                            }
                        }
                    }
                }
            } else {
                Log::error("Invalid rate value for currency $currencyCode: $rate");
            }
        } catch (ConnectionException $e) {
            Log::error('Connection error while fetching currency rates: ' . $e->getMessage());
            throw new Exception('Failed to fetch currency rates from the API.');
        } catch
        (Exception $e) {
            Log::error('Error while updating currency rates: ' . $e->getMessage());
            throw new Exception('An error occurred while updating currency rates.');
        }
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        return CurrencyRate::all()->pluck('rate', 'currency')->toArray();
    }

    /**
     * @param float $amount
     * @param string $toCurrency
     *
     * @return float|null
     */
    public function convertCurrency(float $amount, string $toCurrency): ?float
    {
        $rates = $this->getRates();

        if (isset($rates[$toCurrency])) {
            return round($amount / $rates[$toCurrency], 2);
        }

        Log::warning("Currency $toCurrency not found in rates.");

        return null;
    }

    /**
     * @param float $amount
     * @param array $currencies
     *
     * @return array
     */
    public function getConvertedPrices(float $amount, array $currencies): array
    {
        $convertedPrices = [];

        foreach ($currencies as $currency) {
            $convertedPrices[$currency] = $this->convertCurrency($amount, $currency);
        }

        return $convertedPrices;
    }
}

