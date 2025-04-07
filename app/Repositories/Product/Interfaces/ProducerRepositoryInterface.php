<?php

namespace App\Repositories\Product\Interfaces;

use App\Models\Producer;
use Illuminate\Database\Eloquent\Collection;

interface ProducerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function findById(int $producerId): Producer;

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function getProductByProducer(int $producerId): Producer;

    /**
     * @param array $data
     *
     * @return Producer
     */
    public function create(array $data): Producer;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Producer
     */
    public function update(int $id, array $data): Producer;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
