<?php

namespace App\Repositories\Product;

use App\Filters\ProductFilter;
use App\Filters\ProductSorter;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @const FILTERS_FIELDS
     */
    private const FILTERS_FIELDS = [
        'categories' => 'category_id',
        'producers' => 'producer_id',
        'price_min' => 'price',
        'price_max' => 'price',
    ];

    /**
     * @const SORT_DIRECTIONS
     */
    private const SORT_DIRECTIONS = [
        'default' => 'asc',
        'reverse' => 'desc',
    ];

    /**
     * @const DEFAULT_SORT_FIELD
     */
    private const DEFAULT_SORT_FIELD = 'name';

    /**
     * @param Product $model
     * @param ProductFilter $productFilter
     * @param ProductSorter $productSorter
     */
    public function __construct(
        Product $model,
        protected ProductFilter $productFilter,
        protected ProductSorter $productSorter,
    ) {
        parent::__construct($model);
    }

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return $this->model->with('category', 'producer')->paginate($limitPerPage);
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
}
