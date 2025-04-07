<?php

namespace App\Repositories\Service\Interfaces;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return Service
     */
    public function findById(int $id): Service;

    /**
     * @param array $data
     *
     * @return Service
     */
    public function create(array $data): Service;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Service
     */
    public function update(int $id, array $data): Service;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator;
}
