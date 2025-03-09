<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected ProductRepositoryInterface $productRepository;
    private const PAGE_LIMIT = 15;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $product = $this->productRepository->create($request->all());
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $product = $this->productRepository->findById($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        //
    }
}
