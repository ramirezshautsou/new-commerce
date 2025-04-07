<?php

namespace App\Jobs;

use App\Services\ProductExportQueueService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExportProductsJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function handle(ProductExportQueueService $productExportQueueService): void
    {
        try {
            $productExportQueueService->exportAndQueue();
        } catch (Throwable $e) {
            Log::error('ExportProductsJob failed', ['error' => $e->getMessage()]);
            $this->fail($e);
        }
    }
}
