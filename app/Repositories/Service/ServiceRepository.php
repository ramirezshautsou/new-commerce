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
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return Service::query()->with('serviceType')->paginate($limitPerPage);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): Service
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data): Service
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(int $id, array $data): Service
    {
        $service = $this->model->newQuery()->findOrFail($id);
        $service->update($data);
        return $service;
    }

    public function delete(int $id): bool
    {
        $service = $this->model->newQuery()->find($id);
        if ($service) {
            return $service->delete();
        }
        return false;
    }
}
