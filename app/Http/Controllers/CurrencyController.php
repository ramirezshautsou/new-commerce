<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRateService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    protected CurrencyRateService $currencyRateService;

    /**
     * Конструктор контроллера
     *
     * @param CurrencyRateService $currencyRateService
     */
    public function __construct(CurrencyRateService $currencyRateService)
    {
        $this->currencyRateService = $currencyRateService;
    }

    /**
     * Обновить курсы валют
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRates(): \Illuminate\Http\RedirectResponse
    {
        // Обновляем курсы валют
        $this->currencyRateService->updateRates();

        // Возвращаем сообщение об успешном обновлении
        return back()->with('success', 'Currency rates updated successfully');
    }

    /**
     * Показать текущие курсы валют
     *
     * @return \Illuminate\View\View
     */
    public function showRates(): \Illuminate\View\View
    {
        // Получаем курсы валют
        $rates = $this->currencyRateService->getRates();

        // Возвращаем представление с данными
        return view('admin.currency-rates', compact('rates'));
    }
}
