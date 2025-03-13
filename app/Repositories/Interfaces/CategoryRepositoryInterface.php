<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param int $categoryId
     * @return Category
     */
    public function getProductsByCategory(int $categoryId): Category;
}
