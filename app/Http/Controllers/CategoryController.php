<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected ProductRepositoryInterface $productRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('categories.index', compact('categories'));
    }

    public function show(int $categoryId): View
    {
        $category = $this->categoryRepository->getProductsByCategory($categoryId);

        return view('categories.show', compact('category'));
    }

    public function create(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('categories.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->categoryRepository->create($request->only([
            'name',
            'alias',
        ]));

        return redirect(route('categories.index'))->with('success', 'Category created!');
    }

    public function edit(int $categoryId): View
    {
        $category = $this->categoryRepository->findById($categoryId);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = $this->categoryRepository->findById($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:products,alias,' . $id,
        ]);

        $product->update($validatedData);

        return redirect(route('categories.index'))->with('success', 'Categories updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = $this->categoryRepository->findById($id);
        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Category deleted successfully');
    }

}
