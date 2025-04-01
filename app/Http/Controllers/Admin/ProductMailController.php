<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ExportCompleted;
use App\Models\Product;
use App\Services\ProductExportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductMailController extends Controller
{
    public function __construct(
        protected ProductExportService $productExportService
    ) {}

    public function export(Request $request): RedirectResponse
    {
        $downloadFilePath = $this->productExportService->export();

        return back()->with('success', 'Export completed successfully. Download: ' . $downloadFilePath);
    }
}

