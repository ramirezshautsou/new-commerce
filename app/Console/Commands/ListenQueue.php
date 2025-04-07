<?php

namespace App\Console\Commands;

use App\Mail\ExportCompleted;
use Aws\S3\S3Client;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;
use App\Services\RabbitMq\RabbitMqConnector;
use Throwable;

class ListenQueue extends Command
{
    /**
     * @var string
     */
    protected $signature = 'queue:listen';

    /**
     * @var string
     */
    protected $description = 'Listen to the export queue';

    /**
     * @const LISTEN_QUEUE_NAME
     */
    private const LISTEN_QUEUE_NAME = 'export_queue';

    /**
     * @param S3Client $s3Client
     * @param RabbitMqConnector $rabbitMqConnector
     */
    public function __construct(
        protected S3Client          $s3Client,
        protected RabbitMqConnector $rabbitMqConnector,
    )
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $channel = $this->rabbitMqConnector->getChannel();

            $channel->basic_consume(
                self::LISTEN_QUEUE_NAME,
                '',
                false,
                true,
                false,
                false,
                function (AMQPMessage $msg) {
                    $this->processMessage($msg->getBody());
                }
            );

            while ($channel->is_consuming()) {
                $channel->wait();
            }

        } catch (Exception $e) {
            $this->error('Error handling RabbitMQ message: ' . $e->getMessage());
        } finally {
            $this->cleanup();
        }
    }

    /**
     * @param string $csvData
     *
     * @return void
     */
    private function processMessage(string $csvData): void
    {
        try {
            $fileName = $this->uploadToS3($csvData);
            $this->sendExportCompletedEmail($fileName);
        } catch (Throwable $e) {
            $this->error('Error processing message: ' . $e->getMessage());
        }
    }

    /**
     * @param string $csvData
     *
     * @return string
     *
     * @throws Exception
     */
    private function uploadToS3(string $csvData): string
    {
        $fileName = 'products-' . time() . '.csv';

        try {
            $this->s3Client->putObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $fileName,
                'Body' => $csvData,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error uploading file to S3: ' . $e->getMessage());
        }

        return $fileName;
    }

    /**
     * @param string $fileName
     *
     * @return void
     */
    private function sendExportCompletedEmail(string $fileName): void
    {
        try {
            $downloadUrl = $this->generateDownloadUrl($fileName);
            Mail::to(env('MAIL_ADMIN_ADDRESS'))
                ->send(new ExportCompleted($downloadUrl));
        } catch (Exception $e) {
            $this->error('Error sending email: ' . $e->getMessage());
        }
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function generateDownloadUrl(string $fileName): string
    {
        $bucketUrl = config('filesystems.disks.s3.bucket');
        $storageUrl = env('AWS_URL');

        return "$storageUrl/$bucketUrl/$fileName";
    }

    /**
     * @return void
     */
    private function cleanup(): void
    {
        try {
            $this->rabbitMqConnector->close();
        } catch (Exception $e) {
            $this->error('Error during cleanup: ' . $e->getMessage());
        }
    }
}
