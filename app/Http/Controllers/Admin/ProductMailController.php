<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ExportCompleted;
use App\Models\Product;
use App\Services\ProductExportProcessorService;
use App\Services\ProductExportQueueService;
use App\Services\ProductExportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductMailController extends Controller
{
    public function __construct(
        private readonly ProductExportQueueService $productExportQueueService,
    ) {}

    public function export(Request $request): RedirectResponse
    {
        try {
            $this->productExportQueueService->exportAndQueue();

            return back()->with('success', 'Export completed successfully.');
        } catch (\Exception $exception) {
            return back()->with('error', 'Error starting export: ' . $exception->getMessage());
        }
    }
}

