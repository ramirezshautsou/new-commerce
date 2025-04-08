<?php

namespace App\Services\Export;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExportCompleted;
use Exception;
use Throwable;

class ExportProcessor
{
    /**
     * @param S3Client $s3Client
     *
     * @param S3DownloadUrlService $urlService
     */
    public function __construct(
        protected S3Client $s3Client,
        protected S3DownloadUrlService $urlService,
    ) {}

    /**
     * @param string $csvData
     *
     * @return void
     *
     * @throws Exception
     */
    public function handle(string $csvData): void
    {
        try {
            $fileName = $this->uploadToS3($csvData);
            $this->sendExportCompletedEmail($fileName);
        } catch (Throwable $e) {
            throw new Exception(__('messages.export_failed', ['error' => $e->getMessage()]));
        }
    }

    /**
     * @param string $csvData
     *
     * @return string
     */
    private function uploadToS3(string $csvData): string
    {
        $fileName = 'products-' . time() . '.csv';

        $this->s3Client->putObject([
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $fileName,
            'Body' => $csvData,
        ]);

        return $fileName;
    }

    /**
     * @param string $fileName
     *
     * @return void
     */
    private function sendExportCompletedEmail(string $fileName): void
    {
        $downloadUrl = $this->urlService->generate($fileName);

        Mail::to(env('MAIL_ADMIN_ADDRESS'))
            ->send(new ExportCompleted($downloadUrl));

        Log::info(__('messages.export_completed', ['link' => $downloadUrl]));
    }
}
