<?php

namespace App\View\Composers;

use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;

class CategoryComposer extends BaseComposer
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    ) {
        parent::__construct([
            'categories' => $categoryRepository,
        ]);
    }
}
