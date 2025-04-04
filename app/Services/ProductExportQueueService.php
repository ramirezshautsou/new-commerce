<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ProductExportQueueService
{
    private AMQPStreamConnection $connection;
    private $channel;

    /**
     * @throws \Exception
     */
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {
        try {
            $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
            $this->channel = $this->connection->channel();
        } catch (Exception $e) {
            throw new Exception("Could not connect to RabbitMQ: " . $e->getMessage());
        }
    }

    public function exportAndQueue(): void
    {
        $products = $this->productRepository->getAll();

        $csvData = $this->generateCsvData($products);

        $this->sendToQueue($csvData);
    }

    private function sendToQueue(string $csvData): void
    {
        $msg = new AMQPMessage($csvData);

        $this->channel->queue_declare('export_queue', false, true, false, false);
        $this->channel->basic_publish($msg, '', 'export_queue');
    }

    private function generateCsvData($products): string
    {
        $csvData = "ID,Name,Price\n";
        foreach ($products as $product) {
            $csvData .= $product->id . "," . $product->name . "," . $product->price . "\n";
        }

        return $csvData;
    }

    public function __destruct()
    {
        try {
            // Закрытие канала и соединения
            if ($this->channel) {
                $this->channel->close();
            }

            if ($this->connection) {
                $this->connection->close();
            }
        } catch (Exception $e) {
            echo "Caught exception: " . $e->getMessage() . "\n";
        }
    }
}
