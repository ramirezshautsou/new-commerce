<?php

namespace App\Repositories\Product\Interfaces;

use App\Models\Producer;

interface ProducerRepositoryInterface
{
    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function getProductByProducer(int $producerId): Producer;
}
