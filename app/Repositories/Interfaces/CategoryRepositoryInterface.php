<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getProductsByCategory(int $categoryId);
}
