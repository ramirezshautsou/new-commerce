<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductExportQueueService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class ProductMailController extends Controller
{
    public function __construct(
        private readonly ProductExportQueueService $productExportQueueService,
    ) {}

    public function export(Request $request): RedirectResponse
    {
        try {
            $this->productExportQueueService->exportAndQueue();

            return back()->with('success', __('messages.export_success'));
        } catch (Throwable  $exception) {
            return back()->with('error', __('messages.export_failed', ['error' => $exception->getMessage()]));
        }
    }
}

