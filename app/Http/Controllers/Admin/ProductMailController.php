<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductCsvExporterToQueue;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductMailController extends Controller
{
    /**
     * @param ProductCsvExporterToQueue $productCsvExporterToQueue
     */
    public function __construct(
        private readonly ProductCsvExporterToQueue $productCsvExporterToQueue,
    ) {}

    /**
     * @return RedirectResponse
     */
    public function export(): RedirectResponse
    {
        try {
            $this->productCsvExporterToQueue->exportProductsToQueue();

            return back()->with('success', __('messages.export_success'));
        } catch (Throwable  $exception) {
            return back()->with('error', __('messages.export_failed', [
                'error' => $exception->getMessage(),
            ]));
        }
    }
}

