<?php

namespace App\Repositories\Product\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator;
    public function sort(Builder $query, array $sortArray): Builder;
    public function filter(array $filterArray): Builder;
}
