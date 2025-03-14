<?php

namespace App\Repositories\BaseInterfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return Model
     */
    public function findById(int $id): Model;

    /**
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
