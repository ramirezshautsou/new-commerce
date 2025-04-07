<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRateService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class CurrencyController extends Controller
{
    /**
     * @param CurrencyRateService $currencyRateService
     */
    public function __construct(
        protected CurrencyRateService $currencyRateService,
    ) {}

    /**
     * @return RedirectResponse
     * @throw ConnectionException
     */
    public function updateRates(): RedirectResponse
    {
        try {
            $this->currencyRateService->updateRates();

            return back()->with('success', __('messages.currency_updated_success'));
        } catch (ConnectionException $e) {
            return back()->with('error', __('messages.currency_updated_fail'));
        }

    }

    /**
     * @return View
     */
    public function showRates(): View
    {
        $rates = $this->currencyRateService->getRates();

        return view('admin.currency-rates', compact('rates'));
    }
}
