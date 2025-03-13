<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('categories.index', compact('categories'));
    }

    /**
     * @param int $categoryId
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->categoryRepository->create($request->only([
            'name',
            'alias',
        ]));

        return redirect(route('categories.index'))->with('success', 'Category created!');
    }

    /**
     * @param int $categoryId
     * @return View
     */
    public function edit(int $categoryId): View
    {
        $category = $this->categoryRepository->findById($categoryId);

        return view('categories.edit', compact('category'));
    }

    /**
     * @param Request $request
     * @param int $categoryId
     * @return RedirectResponse
     */
    public function update(Request $request, int $categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->findById($categoryId);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:categories,alias,' . $categoryId,
        ]);

        $category->update($validatedData);

        return redirect(route('categories.index'))->with('success', 'Categories updated successfully');
    }

    /**
     * @param int $categoryId
     * @return RedirectResponse
     */
    public function destroy(int $categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->findById($categoryId);
        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Category deleted successfully');
    }
}
