<?php

namespace App\Services\Currency;

use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Log;

class CurrencyConverter
{
    /**
     * @return array
     */
    public function getRates(): array
    {
        return cache()->remember('currency_rates_tmp', now()->addHour(), function () {
            $rates = CurrencyRate::all()->pluck('rate', 'currency')->toArray();

            if (empty($rates)) {
                return null;
            }

            cache()->put('currency_rates', $rates, now()->addHour());

            return $rates;
        });
    }

    /**
     * @param float $amount
     * @param string $toCurrency
     * @param int $precision
     *
     * @return float|null
     */
    public function convert(float $amount, string $toCurrency, int $precision = 2): ?float
    {
        $rates = $this->getRates();

        if (!isset($rates[$toCurrency])) {
            Log::warning(__('messages.currency_not_found', ['currency' => $toCurrency]));

            return null;
        }

        return round($amount / $rates[$toCurrency], $precision);
    }

    /**
     * @param float $amount
     * @param array $currencies
     *
     * @return array
     */
    public function convertMany(float $amount, array $currencies): array
    {
        $converted = [];
        foreach ($currencies as $currency) {
            $converted[$currency] = $this->convert($amount, $currency);
        }

        return $converted;
    }
}

