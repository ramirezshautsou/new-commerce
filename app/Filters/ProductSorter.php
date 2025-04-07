<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductSorter
{
    /**
     * @const DEFAULT_FIELD
     */
    private const DEFAULT_FIELD = 'name';
    /**
     * @const ALLOWED_DIRECTIONS
     */
    private const ALLOWED_DIRECTIONS = [
        'default' => 'asc',
        'reverse' =>'desc',
    ];

    /**
     * @param Builder $query
     * @param array $sortArray
     *
     * @return Builder
     */
    public function applySort(Builder $query, array $sortArray): Builder
    {
        $field = $sortArray['field'] ?? self::DEFAULT_FIELD;
        $direction = in_array($sortArray['direction']
            ?? self::ALLOWED_DIRECTIONS['default'], self::ALLOWED_DIRECTIONS)
            ? $sortArray['direction'] : self::ALLOWED_DIRECTIONS['default'];

        return $query->orderBy($field, $direction);
    }
}
