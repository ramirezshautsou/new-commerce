<?php

namespace App\Services\Export;

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

        return "$storageUrl/$bucketUrl/$fileName";
    }
}
