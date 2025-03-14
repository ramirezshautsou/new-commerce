<?php

namespace App\Repositories\Product\Interfaces;

use App\Models\Products\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param int $categoryId
     *
     * @return Category
     */
    public function getProductsByCategory(int $categoryId): Category;
}
