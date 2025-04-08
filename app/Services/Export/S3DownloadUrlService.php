<?php

namespace App\Services\Export;

use Illuminate\Support\Facades\Log;

class S3DownloadUrlService
{
    /**
     * @param string $fileName
     *
     * @return string
     */
    public function generate(string $fileName): string
    {
        $bucketUrl = config('filesystems.disks.s3.bucket');
        $storageUrl = env('AWS_URL');
        $downloadUrl = "$storageUrl/$bucketUrl/$fileName";

        Log::info(__('messages.download_url_generated', ['url' => $downloadUrl]));

        return $downloadUrl;
    }
}
