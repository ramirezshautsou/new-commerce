<?php

namespace App\Jobs;

use App\Services\ProductCsvExporterToQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExportProductsJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function handle(ProductCsvExporterToQueue $productCsvExporterToQueue): void
    {
        try {
            $productCsvExporterToQueue->exportProductsToQueue();
        } catch (Throwable $e) {
            Log::error(__('jobs.export_products_failed'), ['error' => $e->getMessage()]);
            $this->fail($e);
        }
    }
}
