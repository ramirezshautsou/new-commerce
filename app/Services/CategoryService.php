<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

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
     * @return Model
     */
    public function updateCategory(CategoryRequest $request, int $categoryId): Model
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
