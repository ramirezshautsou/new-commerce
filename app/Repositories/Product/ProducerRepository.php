<?php

namespace App\Repositories\Product;

use App\Models\Producer;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;

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
     *
     * @return Producer
     */
    public function getProductByProducer(int $producerId): Producer
    {
        return Producer::with('products')->findOrFail($producerId);
    }
}
