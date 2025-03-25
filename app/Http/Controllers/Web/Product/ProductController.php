<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @const PAGE_LIMIT
     */
    private const PAGE_LIMIT = 15;

    /**
     * @param ProductService $productService
     */
    public function __construct(
        private ProductService $productService,
    ) {}

    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view('products.index', [
            'products' => $this->productService
                ->getFilteredProducts(
                    $request->only(['categories', 'producers', 'price_min', 'price_max']),
                    $request->query('sort_by', 'id'),
                    $request->query('sort_order', 'asc'),
                    self::PAGE_LIMIT,
                ),
        ]);
    }

    /**
     * @param int $productId
     *
     * @return View
     */
    public function show(int $productId): View
    {
        return view('products.show', [
            'product' => $this->productService
                ->getProductById($productId),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * @param ProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productService
            ->createProduct($request->validated());

        return redirect(route('products.index'))
            ->with('success', __('messages.created_success', [
                'name' => __('entities.product'),
            ]));
    }

    /**
     * @param int $productId
     *
     * @return View
     */
    public function edit(int $productId): View
    {
        return view('products.edit', [
            'product' => $this->productService
                ->getProductById($productId),
        ]);
    }

    /**
     * @param ProductRequest $request
     * @param int $productId
     *
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, int $productId): RedirectResponse
    {
        $product = $this->productService
            ->updateProduct($productId, $request->validated());

        return redirect(route('products.index'))
            ->with('success', __('messages.updated_success', [
                'name' => __('entities.product'),
            ]));
    }

    /**
     * @param int $productId
     *
     * @return RedirectResponse
     */
    public function destroy(int $productId): RedirectResponse
    {
        $this->productService
            ->deleteProduct($productId);

        return redirect(route('products.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => __('entities.product'),
            ]));
    }
}
