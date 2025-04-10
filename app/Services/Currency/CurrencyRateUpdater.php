<?php

namespace App\Services\Currency;

use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Log;

class CurrencyRateUpdater
{
    /**
     * @const ALLOWED_CURRENCIES
     */
    private const ALLOWED_CURRENCIES = ['USD', 'RUB', 'EUR'];

    private const FILIAL_KEYS = [
        'ratesKey' => 'filials',
        'ratesValue' => 'filial',
        'filialKey' => 'rates',
        'filialValue' => 'value',
        'valueKey' => '@attributes',
        'valueCurrency' => 'iso',
        'valuePrice' => 'sale',
    ];

    /**
     * @param array $rates
     *
     * @return void
     */
    public function update(array $rates): void
    {
        if (!isset($rates[self::FILIAL_KEYS['ratesKey']][self::FILIAL_KEYS['ratesValue']])) {
            Log::error(__('messages.missing_filials'));
            return;
        }

        foreach ($rates[self::FILIAL_KEYS['ratesKey']][self::FILIAL_KEYS['ratesValue']] as $filial) {
            foreach ($filial[self::FILIAL_KEYS['filialKey']][self::FILIAL_KEYS['filialValue']] ?? [] as $value) {
                $iso = $value[self::FILIAL_KEYS['valueKey']][self::FILIAL_KEYS['valueCurrency']] ?? null;
                $sale = $value[self::FILIAL_KEYS['valueKey']][self::FILIAL_KEYS['valuePrice']] ?? null;

                if (in_array($iso, self::ALLOWED_CURRENCIES) && is_numeric($sale)) {
                    CurrencyRate::query()->updateOrCreate(
                        ['currency' => $iso],
                        ['rate' => (float)$sale]
                    );
                } else {
                    Log::warning(__('messages.skipped_currency', [
                        'currency' => json_encode($value),
                    ]));
                }
            }
        }
    }
}

