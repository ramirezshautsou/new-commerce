<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;
use App\Services\RabbitMq\RabbitMqConnector;
use Exception;

class ProductExportQueueService
{
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

        $this->rabbitMqConnector->publish('export_queue', $csvData);
    }

    /**
     * @param $products
     *
     * @return string
     */
    private function generateCsvData($products): string
    {
        $csvData = "ID;Name;Price\n";
        foreach ($products as $product) {
            $csvData .= $product->id . ";" . $product->name . ";" . $product->price . "\n";
        }

        return $csvData;
    }
}
