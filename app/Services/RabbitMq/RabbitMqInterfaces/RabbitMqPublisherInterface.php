<?php

namespace App\Services\RabbitMq\RabbitMqInterfaces;

interface RabbitMqPublisherInterface
{
    /**
     * @param string $queue
     * @param string $message
     *
     * @return void
     */
    public function publish(string $queue, string $message): void;
}
