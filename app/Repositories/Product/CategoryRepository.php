<?php

namespace App\Repositories\Product;

use App\Models\Products\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $categoryId
     *
     * @return Category
     */
    public function getProductsByCategory(int $categoryId): Category
    {
        return Category::with('products')->findOrFail($categoryId);
    }
}
