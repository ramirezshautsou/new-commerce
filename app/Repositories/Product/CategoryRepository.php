<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(
        protected Category $model,
    ) {}

    /**
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): Category
    {
        return $this->model->newQuery()->findOrFail($categoryId);
    }

    /**
     * @param int $categoryId
     *
     * @return Category
     */
    public function getProductsByCategory(int $categoryId): Category
    {
        return $this->model->newQuery()->with('products')->findOrFail($categoryId);
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Category
     */
    public function update(int $id, array $data): Category
    {
        $category = $this->model->newQuery()->findOrFail($id);
        $category->update($data);

        return $category;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $category = $this->model->newQuery()->find($id);
        if ($category) {
            return $category->delete();
        }

        return false;
    }
}
