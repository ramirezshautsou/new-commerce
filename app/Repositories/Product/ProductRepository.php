<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
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
        return Product::query()->with('category', 'producer')->paginate($limitPerPage);
    }

    public function sort(Builder $query, array $sortArray): Builder
    {
        $field = $sortArray['field'] ?? 'name';
        $direction = $sortArray['direction'] ?? 'asc';

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query->orderBy($field, $direction);

        return $query;
    }

    public function filter(array $filterArray): Builder
    {
        $query = Product::query();

        $filters = [
            'categories' => 'category_id',
            'producers' => 'producer_id',
            'price_min' => 'price',
            'price_max' => 'price',
        ];

        foreach ($filters as $filter => $column) {
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
}
