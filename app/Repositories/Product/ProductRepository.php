<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private const FILTERS_FIELDS = [
        'categories' => 'category_id',
        'producers' => 'producer_id',
        'price_min' => 'price',
        'price_max' => 'price',
    ];

    private const SORT_DIRECTIONS = [
        'default' => 'asc',
        'reverse' => 'desc',
    ];

    private const DEFAULT_SORT_FIELD = 'name';

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
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

        foreach (self::FILTERS_FIELDS as $filter => $column) {
            if (!empty($filterArray[$filter])) {
                $operator = ($filter === 'price_min') ? '>=' : ($filter === 'price_max' ? '<=' : '=');
                $value = $filterArray[$filter];

                if (is_array($value)) {
                    $query->whereIn($column, $value);
                } else {
                    $query->where($column, $operator, $value);
                }
            }
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param array $sortArray
     *
     * @return Builder
     */
    public function sort(Builder $query, array $sortArray): Builder
    {
        $field = $sortArray['field'] ?? self::DEFAULT_SORT_FIELD;
        $direction = $sortArray['direction'] ?? self::SORT_DIRECTIONS['default'];

        if (!in_array($direction, self::SORT_DIRECTIONS)) {
            $direction = self::SORT_DIRECTIONS['default'];
        }

        $query->orderBy($field, $direction);

        return $query;
    }
}
