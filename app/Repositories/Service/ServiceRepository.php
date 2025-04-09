<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @param Service $model
     */
    public function __construct(
        protected Service $model,
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
     * @param int $id
     *
     * @return Service
     */
    public function findById(int $id): Service
    {
        return $this->model->newQuery()
            ->findOrFail($id);
    }

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with('serviceType')
            ->paginate($limitPerPage);
    }

    /**
     * @param array $data
     *
     * @return Service
     */
    public function create(array $data): Service
    {
        return $this->model->newQuery()
            ->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Service
     */
    public function update(int $id, array $data): Service
    {
        $service = $this->model->newQuery()
            ->findOrFail($id);
        $service->update($data);

        return $service;
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
