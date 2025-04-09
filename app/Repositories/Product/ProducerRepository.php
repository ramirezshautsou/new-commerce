<?php

namespace App\Repositories\Product;

use App\Models\Producer;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProducerRepository implements ProducerRepositoryInterface
{
    /**
     * @param Producer $model
     */
    public function __construct(
        protected Producer $model,
    ) {}

    /**
     * @param int|null $limit
     *
     * @return Collection
     */
    public function getAll(?int $limit = null): Collection
    {
        $query = $this->model->newQuery();

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->paginate($limitPerPage);
    }

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function findById(int $producerId): Producer
    {
        return $this->model->newQuery()
            ->findOrFail($producerId);
    }

    /**
     * @param int $producerId
     *
     * @return Producer
     */
    public function findProducerWithProducts(int $producerId): Producer
    {
        return $this->model->newQuery()
            ->with('products')
            ->findOrFail($producerId);
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
        $producer = $this->model->newQuery()
            ->findOrFail($id);
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
        return (bool) $this->model->newQuery()
            ->find($id)
            ?->delete();
    }
}
