<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    protected ProductRepositoryInterface $productRepository;

    /**
     * @var CategoryRepositoryInterface
     */
    protected CategoryRepositoryInterface $categoryRepository;

    /**
     * @var string $name
     */
    protected string $name;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->name = __('entities.category');
    }

    /**
     * @return View
     */

    public function index(): View
    {
        return view('categories.index', [
            'categories' => $this->categoryRepository->getAll()
        ]);
    }

    /**
     * @param int $categoryId
     *
     * @return View
     */
    public function show(int $categoryId): View
    {
        $category = $this->categoryRepository->getProductsByCategory($categoryId);

        return view('categories.show', compact('category'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('categories.create', compact('categories'));
    }

    /**
     * @param CategoryRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->categoryRepository->create($validatedData);

        return redirect(route('categories.index'))
            ->with('success', __('messages.created_success', [
                'name' => $this->name,
            ]));
    }

    /**
     * @param int $categoryId
     *
     * @return View
     */
    public function edit(int $categoryId): View
    {
        $category = $this->categoryRepository->findById($categoryId);

        return view('categories.edit', compact('category'));
    }

    /**
     * @param ProducerRequest $request
     * @param int $categoryId
     *
     * @return RedirectResponse
     */
    public function update(ProducerRequest $request, int $categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->findById($categoryId);

        $validatedData = $request->validated();

        $category->update($validatedData);

        return redirect(route('categories.index'))
            ->with('success', __('messages.updated_success', [
                'name' => $this->name,
            ]));
    }

    /**
     * @param int $categoryId
     *
     * @return RedirectResponse
     */
    public function destroy(int $categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->findById($categoryId);
        $category->delete();

        return redirect(route('categories.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
