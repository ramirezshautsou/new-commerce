<?php

namespace App\Jobs;

use App\Services\ProductExportQueueService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportProductsJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function handle(ProductExportQueueService $productExportQueueService): void
    {
        $productExportQueueService->exportAndQueue();
    }
}
