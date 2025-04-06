<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryService $categoryService
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected CategoryService               $categoryService,
    ) {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('categories.index');
    }

    /**
     * @param int $categoryId
     *
     * @return View
     */
    public function show(int $categoryId): View
    {
        return view('categories.show', [
            'category' => $this->categoryRepository
                ->getProductsByCategory($categoryId),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * @param CategoryRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryRepository
            ->create($request->validated());

        return redirect(route('categories.index'))
            ->with('success', __('messages.created_success', [
                'name' => __('entities.category'),
            ]));
    }

    /**
     * @param int $categoryId
     *
     * @return View
     */
    public function edit(int $categoryId): View
    {
        return view('categories.edit', [
            'category' => $this->categoryRepository
                ->findById($categoryId),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param int $categoryId
     *
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, int $categoryId): RedirectResponse
    {
        $this->categoryService
            ->updateCategory($request, $categoryId);

        return redirect(route('categories.index'))
            ->with('success', __('messages.updated_success', [
                'name' => __('entities.category'),
            ]));
    }

    /**
     * @param int $categoryId
     *
     * @return RedirectResponse
     */
    public function destroy(int $categoryId): RedirectResponse
    {
        $this->categoryService
            ->deleteCategory($categoryId);

        return redirect(route('categories.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => __('entities.category'),
            ]));
    }
}
