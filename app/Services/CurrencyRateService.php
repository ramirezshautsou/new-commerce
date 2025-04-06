<?php

namespace App\Services;

use App\Models\CurrencyRate;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class CurrencyRateService
{
    /**
     * Обновление курсов валют
     *
     * @return void
     *
     * @throws ConnectionException
     */
    public function updateRates(): void
    {
        // Получаем данные с API
        $response = Http::withOptions([
            'verify' => false,
        ])->get(env('RATES_URL'));

        // Проверяем, успешен ли запрос
        if ($response->successful()) {
            // Получаем XML данные
            $xml = simplexml_load_string($response->body());

            // Преобразуем XML в массив
            $rates = json_decode(json_encode($xml), true);

            // Если курсы валют пустые, выведем ошибку
            if (empty($rates)) {
                dd('API returned empty rates:', $rates);
            }

            // Проверяем, что $rates является массивом
            if (is_array($rates)) {
                // Обновляем или создаём новые записи
                foreach ($rates['filials']['filial'] as $filial) {
                    foreach ($filial['rates']['value'] as $value) {
                        // Извлекаем валюту и курс
                        $currencyCode = (string)$value['@attributes']['iso'];
                        $rate = (float)$value['@attributes']['sale'];

                        // Проверяем, что курс является числом
                        if (is_numeric($rate)) {
                            CurrencyRate::query()->updateOrCreate(
                                ['currency' => $currencyCode], // Параметры для поиска
                                ['rate' => $rate] // Данные для обновления
                            );
                        } else {
                            dd("Invalid rate value for currency $currencyCode: $rate");
                        }
                    }
                }
            } else {
                dd('The response is not a valid XML structure:', $rates);
            }
        } else {
            // Если запрос не успешен, выводим ошибку
            dd('Request failed:', $response->status(), $response->body());
        }
    }

    /**
     * Получить все курсы валют из базы данных
     *
     * @return array
     */
    public function getRates(): array
    {
        return CurrencyRate::all()->pluck('rate', 'currency')->toArray();
    }

    public function convertCurrency(float $amount, string $toCurrency): ?float
    {
        $rates = $this->getRates();

        return isset($rates[$toCurrency]) ? round($amount / $rates[$toCurrency], 2) : null;
    }
}

