<?php

namespace App\Repositories\Product\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $categoryId
     *
     * @return Category
     */
    public function findById(int $categoryId): Category;

    /**
     * @param int $categoryId
     *
     * @return Category
     */
    public function getProductsByCategory(int $categoryId): Category;

    /**
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * @param int $id
     * @param array $data
     *
     * @return Category
     */
    public function update(int $id, array $data): Category;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
