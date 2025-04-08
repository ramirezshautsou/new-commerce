<?php

namespace App\Services\Currency;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Http\Client\ConnectionException;

class CurrencyFetcher
{
    /**
     * @return array
     *
     * @throws ConnectionException
     * @throws Exception
     */
    public function fetch(): array
    {
        $response = Http::withOptions(['verify' => false])
            ->get(env('RATES_URL'));

        if ($response->failed()) {
            throw new ConnectionException(__('messages.request_failed', ['status' => $response->status()]));
        }

        $xml = simplexml_load_string($response->body());
        if ($xml === false) {
            throw new Exception(__('messages.invalid_xml'));
        }

        return json_decode(json_encode($xml), true);
    }
}
