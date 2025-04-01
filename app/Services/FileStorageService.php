<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileStorageService
{
    public function storeToS3(string $filePath, string $data): bool
    {
        return Storage::disk('s3')->put($filePath, $data);
    }
}
