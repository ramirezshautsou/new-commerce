<?php

namespace App\Console\Commands;

use App\Mail\ExportCompleted;
use Aws\S3\S3Client;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;
use App\Services\RabbitMq\RabbitMqConnector;

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

    private $channel;

    /**
     * @param S3Client $s3Client
     * @param RabbitMqConnector $rabbitMqConnector
     */
    public function __construct(
        protected S3Client $s3Client,
        protected RabbitMqConnector $rabbitMqConnector
    ) {
        parent::__construct();
    }

    /**
     * @return void
     *
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            // Получаем канал с помощью RabbitMqConnector
            $connection = $this->rabbitMqConnector->connect();
            $this->channel = $connection->channel();

            // Начинаем прослушивание очереди
            $this->channel->basic_consume(
                'export_queue',
                '',
                false,
                true,
                false,
                false,
                function (AMQPMessage $msg) {
                    $this->processMessage($msg->getBody());
                }
            );

            // Ожидаем сообщений в очереди
            while ($this->channel->is_consuming()) {
                $this->channel->wait();
            }

        } catch (Exception $e) {
            $this->error('Error handling RabbitMQ message: ' . $e->getMessage());
        } finally {
            $this->cleanup();
        }
    }

    /**
     * Обработка сообщения из очереди
     *
     * @param string $csvData
     *
     * @return void
     */
    private function processMessage(string $csvData): void
    {
        try {
            $fileName = $this->uploadToS3($csvData);
            $this->sendExportCompletedEmail($fileName);
        } catch (\Throwable $e) {
            $this->error('Error processing message: ' . $e->getMessage());
        }
    }

    /**
     * Загрузка CSV файла на S3
     *
     * @param string $csvData
     *
     * @return string
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
     * Отправка письма об окончании экспорта
     *
     * @param string $fileName
     *
     * @return void
     */
    private function sendExportCompletedEmail(string $fileName): void
    {
        try {
            $downloadUrl = $this->generateDownloadUrl($fileName);
            Mail::to('test@test.com')->send(new ExportCompleted($downloadUrl));
        } catch (Exception $e) {
            $this->error('Error sending email: ' . $e->getMessage());
        }
    }

    /**
     * Генерация URL для скачивания файла
     *
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
     * Очистка ресурсов (закрытие канала и соединения)
     */
    private function cleanup(): void
    {
        try {
            if ($this->channel) {
                $this->channel->close();
            }

            if (isset($connection) && $connection) {
                $connection->close();
            }
        } catch (Exception $e) {
            $this->error('Error during cleanup: ' . $e->getMessage());
        }
    }
}
