<?php

namespace App\Services;

use App\Mail\ExportCompleted;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Mail;

readonly class ProductExportService
{
    public function __construct(
        private ProductRepository  $productRepository,
        private FileStorageService $fileStorageService,
    ) {}

    public function export(): string
    {
        $products = $this->productRepository->getAll();

        // Формируем данные для CSV
        $csvData = $this->generateCsvData($products);

        $filePath = 'products.csv';

        $this->fileStorageService->storeToS3($filePath, $csvData);

        $downloadFilePath = $this->generateDownloadUrl($filePath);

        $this->sendExportCompletedEmail($downloadFilePath);

        return $downloadFilePath;
    }

    private function generateCsvData($products): string
    {
        $csvData = "ID,Name,Price\n";
        foreach ($products as $product) {
            $csvData .= $product->id . "," . $product->name . "," . $product->price . "\n";
        }

        return $csvData;
    }

    private function generateDownloadUrl(string $filePath): string
    {
        $bucketUrl = config('filesystems.disks.s3.bucket');
        $storageUrl = env('AWS_URL');

        return "$storageUrl/$bucketUrl/$filePath";
    }

    private function sendExportCompletedEmail(string $downloadUrl): void
    {
        Mail::to('test@test.com')->send(new ExportCompleted($downloadUrl));
    }
}
