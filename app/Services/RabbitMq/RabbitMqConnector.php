<?php

namespace App\Services\RabbitMq;

use App\Services\RabbitMq\RabbitMqInterfaces\RabbitMqPublisherInterface;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqConnector implements RabbitMqPublisherInterface
{
    /**
     * @var AMQPStreamConnection|null
     */
    private ?AMQPStreamConnection $connection = null;

    /**
     * @var AMQPChannel|null
     */
    private ?AMQPChannel $channel = null;

    /**
     * @return AMQPStreamConnection
     *
     * @throws Exception
     */
    public function connect(): AMQPStreamConnection
    {
        if (!$this->connection) {
            try {
                $this->connection = new AMQPStreamConnection(
                    config('queue.rabbitmq.host', 'rabbitmq'),
                    config('queue.rabbitmq.port', 5672),
                    config('queue.rabbitmq.user', 'guest'),
                    config('queue.rabbitmq.password', 'guest')
                );

                $this->channel = $this->connection->channel();
            } catch (Exception $e) {
                throw new Exception("RabbitMQ connection failed: " . $e->getMessage(), $e->getCode(), $e);
            }
        }
        return $this->connection;
    }

    /**
     * @return AMQPChannel
     *
     * @throws Exception
     */
    public function getChannel(): AMQPChannel
    {
        if (!$this->channel) {
            $this->connect();
        }

        return $this->channel;
    }

    /**
     * @param string $queue
     * @param string $message
     *
     * @return void
     *
     * @throws Exception
     */
    public function publish(string $queue, string $message): void
    {
        try {
            $this->connect();

            $this->channel->queue_declare($queue, false, true, false, false);

            $this->channel->basic_publish(
                new AMQPMessage($message),
                '',
                $queue
            );
        } catch (Exception $e) {
            $errorMessage = __('messages.rabbitmq_publish_failed', ['error' => $e->getMessage()]);
            throw new Exception($errorMessage, $e->getCode(), $e);        }
    }

    /**
     * @return void
     *
     * @throws Exception
     */
    public function close(): void
    {
        $this->channel?->close();
        $this->connection?->close();
    }
}
