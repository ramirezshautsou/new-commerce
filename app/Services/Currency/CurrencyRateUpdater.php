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

    /**
     * @param array $rates
     *
     * @return void
     */
    public function update(array $rates): void
    {
        if (!isset($rates['filials']['filial'])) {
            Log::error(__('messages.missing_filials'));
            return;
        }

        foreach ($rates['filials']['filial'] as $filial) {
            foreach ($filial['rates']['value'] ?? [] as $value) {
                $iso = $value['@attributes']['iso'] ?? null;
                $sale = $value['@attributes']['sale'] ?? null;

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

