<?php

namespace App\Repositories;

use App\Models\Producer;
use App\Repositories\Interfaces\ProducerRepositoryInterface;

class ProducerRepository extends BaseRepository implements ProducerRepositoryInterface
{
    /**
     * @param Producer $model
     */
    public function __construct(Producer $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $producerId
     * @return Producer
     */
    public function getProductByProducer(int $producerId): Producer
    {
        return Producer::with('products')->findOrFail($producerId);
    }
}
