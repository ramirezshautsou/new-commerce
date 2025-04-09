<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Services\Filters\ProductFilter;
use App\Services\Filters\ProductSorter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @param Product $model
     * @param ProductFilter $productFilter
     * @param ProductSorter $productSorter
     */
    public function __construct(
        protected Product $model,
        protected ProductFilter $productFilter,
        protected ProductSorter $productSorter,
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
     * @return Product
     */
    public function findById(int $id): Product
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
            ->with('category', 'producer')
            ->paginate($limitPerPage);
    }

    /**
     * @param array $filterArray
     *
     * @return Builder
     */
    public function filter(array $filterArray): Builder
    {
        $query = $this->model->newQuery();

        return $this->productFilter->applyFilter($query, $filterArray);
    }

    /**
     * @param Builder $query
     * @param array $sortArray
     *
     * @return Builder
     */
    public function sort(Builder $query, array $sortArray): Builder
    {
        return $this->productSorter->applySort($query, $sortArray);
    }

    /**
     * @param array $data
     *
     * @return Product
     */
    public function create(array $data): Product
    {
        return $this->model->newQuery()
            ->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Product
     */
    public function update(int $id, array $data): Product
    {
        $product = $this->findById($id);
        $product->update($data);

        return $product;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return (bool) $this->model->newQuery()
            ->find($id)
            ?->delete();
    }

    /**
     * @param int $id
     *
     * @return float
     */
    public function price(int $id): float
    {
        return $this->model->newQuery()
            ->find($id)
            ->price;
    }
}
