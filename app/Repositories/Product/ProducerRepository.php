<?php

namespace App\Repositories\Product;

use App\Models\Producer;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProducerRepository implements ProducerRepositoryInterface
{
    /**
     * @param Producer $model
     */
    public function __construct(
        protected Producer $model,
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function findById(int $producerId): Producer
    {
        return $this->model->newQuery()->findOrFail($producerId);
    }

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function getProductByProducer(int $producerId): Producer
    {
        return $this->model->with('products')->findOrFail($producerId);
    }

    /**
     * @param array $data
     *
     * @return Producer
     */
    public function create(array $data): Producer
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Producer
     */
    public function update(int $id, array $data): Producer
    {
        $producer = $this->model->newQuery()->findOrFail($id);
        $producer->update($data);

        return $producer;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $producer = $this->model->newQuery()->find($id);
        if ($producer) {
            return $producer->delete();
        }

        return false;
    }
}
