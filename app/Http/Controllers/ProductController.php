<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected ProductRepositoryInterface $productRepository;
    protected RepositoryInterface $repository;
    private const PAGE_LIMIT = 15;

    public function __construct(ProductRepositoryInterface $productRepository, RepositoryInterface $repository)
    {
        $this->productRepository = $productRepository;
        $this->repository = $repository;
    }

    public function index(): View
    {
        $products = $this->productRepository->paginate(self::PAGE_LIMIT);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => $this->repository->getAll(),
            'producers' => Producer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $product = $this->repository->create($request->only([
            'category_id',
            'name',
            'alias',
            'description',
            'producer_id',
            'production_date',
            'price'
        ]));
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $product = $this->repository->findById($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $product = $this->repository->findById($id);
        $categories = $this->repository->getAll();
        $producers = Producer::all();

        return view('products.edit', compact('product', 'categories', 'producers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $product = $this->repository->findById($id);

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:products,alias,' . $id,
            'description' => 'nullable|string',
            'producer_id' => 'required|exists:producers,id',
            'production_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
        ]);

        $product->update($validatedData);

        return redirect(route('products.index'))->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = $this->repository->findById($id);
        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }
}
