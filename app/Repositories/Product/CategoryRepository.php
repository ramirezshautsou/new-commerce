<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return $this->model->newQuery()
            ->with('products')
            ->findOrFail($categoryId);
    }

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
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category
    {
        return $this->model->newQuery()
            ->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Category
     */
    public function update(int $id, array $data): Category
    {
        $category = $this->model->newQuery()
            ->findOrFail($id);
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
        return (bool) $this->model->newQuery()
            ->find($id)
            ?->delete();
    }
}
