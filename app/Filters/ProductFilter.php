<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    /**
     * @param Builder $query
     * @param array $filterArray
     *
     * @return Builder
     */
    public function applyFilter(Builder $query, array $filterArray): Builder
    {
        foreach ($filterArray as $filter => $value) {
            if ($value === null || $value === '') continue;

            match ($filter) {
                'categories' => $query->whereIn('category_id', (array) $value),
                'producers' => $query->whereIn('producer_id', (array) $value),
                'price_min' => $query->where('price', '>=', $value),
                'price_max' => $query->where('price', '<=', $value),
                default => null,
            };
        }

        return $query;
    }
}
