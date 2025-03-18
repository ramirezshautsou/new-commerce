<?php

namespace App\Services;

use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\CategoryRepository;

class CategoryService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }

    public function updateCategory(ProducerRequest $request, int $categoryId)
    {
        $category = $this->categoryRepository->findById($categoryId);

        $category->update($request->validated());

        return $category;
    }
}
