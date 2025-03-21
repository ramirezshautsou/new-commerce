<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
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

    public function sort(array $sortArray): LengthAwarePaginator
    {
        $query = Product::query();

        $field = $sortArray['field'] ?? 'name';
        $direction = $sortArray['direction'] ?? 'asc';

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query->orderBy($field, $direction);

        return $query->paginate(10);
    }
}
