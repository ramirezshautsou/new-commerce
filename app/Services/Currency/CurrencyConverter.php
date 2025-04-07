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
        return CurrencyRate::all()->pluck('rate', 'currency')->toArray();
    }

    /**
     * @param float $amount
     * @param string $toCurrency
     *
     * @return float|null
     */
    public function convert(float $amount, string $toCurrency): ?float
    {
        $rates = $this->getRates();

        if (!isset($rates[$toCurrency])) {
            Log::warning("Currency $toCurrency not found in rates.");
            return null;
        }

        return round($amount / $rates[$toCurrency], 2);
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

