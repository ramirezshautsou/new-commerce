<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): Model
    {
        return $this->model->query()->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->query()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $product = $this->model->query()->findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id) > 0;
    }
}
