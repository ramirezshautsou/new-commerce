<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRateService;
use Exception;
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
     */
    public function updateRates(): RedirectResponse
    {
        try {
            $this->currencyRateService->updateRates();

            return back()->with('success', __('messages.currency_updated_success'));
        } catch (Exception) {
            return back()->with('error', __('messages.currency_updated_fail'));
        }

    }

    /**
     * @return View
     */
    public function showRates(): View
    {
        return view('admin.currency-rates', [
            'rates' => $this->currencyRateService->getRates(),
        ]);
    }
}
