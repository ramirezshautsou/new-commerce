<?php

namespace App\Services;

use App\Formatters\ProductCsvFormatter;
use App\Repositories\Product\ProductRepository;
use App\Services\RabbitMq\RabbitMqConnector;
use Exception;

class ProductCsvExporterToQueue
{
    /**
     * @const QUEUE_NAME
     */
    private const QUEUE_NAME = 'export_queue';

    /**
     * @param ProductRepository $productRepository
     * @param RabbitMqConnector $rabbitMqConnector
     * @param ProductCsvFormatter $productCsvFormatter
     */
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly RabbitMqConnector $rabbitMqConnector,
        private readonly ProductCsvFormatter $productCsvFormatter,
    ) {}

    /**
     * @return void
     *
     * @throws Exception
     */
    public function exportProductsToQueue(): void
    {
        $products = $this->productRepository->getAll();
        $csvData = $this->productCsvFormatter->format($products);
        $this->rabbitMqConnector->publish(self::QUEUE_NAME, $csvData);
    }
}
