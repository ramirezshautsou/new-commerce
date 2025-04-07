<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    /**
     * @param CategoryRequest $request
     * @param int $categoryId
     *
     * @return Category
     */
    public function updateCategory(CategoryRequest $request, int $categoryId): Category
    {
        $category = $this->categoryRepository->findById($categoryId);
        $category->update($request->validated());

        return $category;
    }

    /**
     * @param int $categoryId
     *
     * @return void
     */
    public function deleteCategory(int $categoryId): void
    {
        $category = $this->categoryRepository
            ->findById($categoryId);
        $category->delete();
    }
}
