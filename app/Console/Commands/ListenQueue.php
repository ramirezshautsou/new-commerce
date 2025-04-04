<?php

namespace App\Console\Commands;

use App\Mail\ExportCompleted;
use Aws\S3\S3Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ListenQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to the export queue';

    public function __construct(
        protected S3Client $s3Client,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle(): void
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->basic_consume(
            'export_queue',
            '',
            false,
            true,
            false,
            false,
            function (AMQPMessage $msg) {
                $messageBody = $msg->getBody();

                $fileName = $this->uploadToS3($messageBody);

                $this->sendExportCompletedEmail($fileName);
            });

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function uploadToS3(string $csvData): string
    {
        $fileName = 'products-' . time() . '.csv';

        // Загружаем данные на S3
        $this->s3Client->putObject([
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $fileName,
            'Body' => $csvData,  // Вместо файла передаем данные
        ]);

        return $fileName;
    }

    private function sendExportCompletedEmail($fileName): void
    {
        $downloadUrl = $this->generateDownloadUrl($fileName);

        Mail::to('test@test.com')->send(new ExportCompleted($downloadUrl));
    }

    private function generateDownloadUrl(string $fileName): string
    {
        $bucketUrl = config('filesystems.disks.s3.bucket');
        $storageUrl = 'http://localhost:4566';

        return "$storageUrl/$bucketUrl/$fileName";
    }
}
