<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;
use App\Services\RabbitMq\RabbitMqConnector;
use Exception;

class ProductExportQueueService
{
    /**
     * @const QUEUE_NAME
     */
    private const QUEUE_NAME = 'export_queue';

    /**
     * @const CSV_COLUMNS
     */
    private const CSV_COLUMNS = "ID;Name;Price\n";

    /**
     * @param ProductRepository $productRepository
     * @param RabbitMqConnector $rabbitMqConnector
     */
    public function __construct(
        private readonly ProductRepository $productRepository,
        protected RabbitMqConnector $rabbitMqConnector,
    ) {}

    /**
     * @return void
     *
     * @throws Exception
     */
    public function exportAndQueue(): void
    {
        $products = $this->productRepository->getAll();
        $csvData = $this->generateCsvData($products);
        $this->rabbitMqConnector->publish(self::QUEUE_NAME, $csvData);
    }

    /**
     * @param $products
     *
     * @return string
     */
    private function generateCsvData($products): string
    {
        $csvData = self::CSV_COLUMNS;
        foreach ($products as $product) {
            $csvData .= $product->id . ";" . $product->name . ";" . $product->price . "\n";
        }

        return $csvData;
    }
}
