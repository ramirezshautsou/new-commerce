<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductExportQueueService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductMailController extends Controller
{
    /**
     * @param ProductExportQueueService $productExportQueueService
     */
    public function __construct(
        private readonly ProductExportQueueService $productExportQueueService,
    ) {}

    /**
     * @return RedirectResponse
     */
    public function export(): RedirectResponse
    {
        try {
            $this->productExportQueueService->exportAndQueue();

            return back()->with('success', __('messages.export_success'));
        } catch (Throwable  $exception) {
            return back()->with('error', __('messages.export_failed', ['error' => $exception->getMessage()]));
        }
    }
}

