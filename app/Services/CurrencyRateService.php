<?php

namespace App\Services;

use App\Services\Currency\CurrencyConverter;
use App\Services\Currency\CurrencyFetcher;
use App\Services\Currency\CurrencyRateUpdater;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class CurrencyRateService
{
    /**
     * @param CurrencyFetcher $fetcher
     * @param CurrencyRateUpdater $updater
     * @param CurrencyConverter $converter
     */
    public function __construct(
        protected CurrencyFetcher $fetcher,
        protected CurrencyRateUpdater $updater,
        protected CurrencyConverter $converter,
    ) {}

    /**
     * @return void
     *
     * @throws Exception
     */
    public function updateRates(): void
    {
        try {
            $raw = $this->fetcher->fetch();
            $this->updater->update($raw);
        } catch (Throwable $e) {
            Log::error('Currency update failed: ' . $e->getMessage());
            throw new Exception('Currency rate update error.');
        }
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        return $this->converter->getRates();
    }

    /**
     * @param float $amount
     * @param string $toCurrency
     *
     * @return float|null
     */
    public function convertCurrency(float $amount, string $toCurrency): ?float
    {
        return $this->converter->convert($amount, $toCurrency);
    }

    /**
     * @param float $amount
     * @param array $currencies
     *
     * @return array
     */
    public function getConvertedPrices(float $amount, array $currencies): array
    {
        return $this->converter->convertMany($amount, $currencies);
    }
}


