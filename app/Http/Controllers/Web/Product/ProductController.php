<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\CurrencyRateService;
use App\Services\ProductExportQueueService;
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
     * @const FILTER_COLUMNS
     */
    private const FILTER_COLUMNS = ['categories', 'producers', 'price_min', 'price_max'];

    /**
     * @const DEFAULT_SORT_COLUMN_NAME
     */
    private const DEFAULT_SORT_COLUMN_NAME = 'id';

    /**
     * @const DEFAULT_SORT_DIRECTION
     */
    private const DEFAULT_SORT_DIRECTION = 'asc';

    /**
     * @param ProductService $productService
     * @param ProductExportQueueService $productExportService
     * @param CurrencyRateService $currencyRateService
     */
    public function __construct(
        protected ProductService         $productService,
        protected ProductExportQueueService $productExportService,
        protected CurrencyRateService  $currencyRateService,
    ) {}

    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = $request->only(self::FILTER_COLUMNS);
        $sortBy = $request->query('sort_by', self::DEFAULT_SORT_COLUMN_NAME);
        $sortDirection = $request->query('sort_order', self::DEFAULT_SORT_DIRECTION);

        return view('products.index', [
            'products' => $this->productService
                ->getFilteredProducts($filters, $sortBy, $sortDirection, self::PAGE_LIMIT),
        ]);
    }

    /**
     * @param int $productId
     *
     * @return View
     */
    public function show(int $productId): View
    {
        $product = Product::query()->findOrFail($productId); //

        return view('products.show', [
            'product' => $this->productService
                ->getProductById($productId),
            'convertedPrices' => [
                'USD' => $this->currencyRateService
                    ->convertCurrency($product->price, 'USD'), //
                'EUR' => $this->currencyRateService
                    ->convertCurrency($product->price, 'EUR'), //
                'RUB' => $this->currencyRateService
                    ->convertCurrency($product->price, 'RUB'), //
            ]
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
        $this->productService
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
