<?php

namespace App\Jobs;

use App\Services\ProductExportQueueService;
use App\Services\ProductExportService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ExportProductsJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(ProductExportQueueService $productExportQueueService): void
    {
        $productExportQueueService->exportAndQueue();
    }

    /**
     * @throws \Exception
     */
    private function sendToQueue(string $filePath, string $csvData): void
    {
        $msg = new AMQPMessage($csvData);

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->basic_publish($msg, '', 'export_queue');

        $channel->close();
        $connection->close();
    }
}
