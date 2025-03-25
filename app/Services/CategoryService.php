<?php

namespace App\Services;

use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    public function updateCategory(ProducerRequest $request, int $categoryId): Model
    {
        $category = $this->categoryRepository->findById($categoryId);
        $category->update($request->validated());

        return $category;
    }

    public function deleteCategory(int $categoryId): void
    {
        $category = $this->categoryRepository
            ->findById($categoryId);
        $category->delete();
    }
}
