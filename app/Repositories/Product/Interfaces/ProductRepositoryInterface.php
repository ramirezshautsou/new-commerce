<?php

namespace App\Repositories\Product\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return Product
     */
    public function findById(int $id): Product;

    /**
     * @param array $data
     *
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Product
     */
    public function update(int $id, array $data): Product;

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

    /**
     * @param Builder $query
     * @param array $sortArray
     *
     * @return Builder
     */
    public function sort(Builder $query, array $sortArray): Builder;

    /**
     * @param array $filterArray
     *
     * @return Builder
     */
    public function filter(array $filterArray): Builder;

    /**
     * @param int $id
     *
     * @return float
     */
    public function price(int $id): float;
}
