<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @const PAGE_LIMIT
     */
    private const PAGE_LIMIT = 15;

    /**
     * @var string $name
     */
    protected string $name;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProducerRepositoryInterface $producerRepository
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        protected ProductRepositoryInterface  $productRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProducerRepositoryInterface $producerRepository,
        protected ServiceRepositoryInterface  $serviceRepository,
    )
    {
        $this->name = __('entities.product');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => $this->productRepository
                ->paginate(self::PAGE_LIMIT),
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
            'product' => $this->productRepository
                ->findById($productId),
            'services' => $this->serviceRepository
                ->getAll(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => $this->categoryRepository
                ->getAll(),
            'producers' => $this->producerRepository
                ->getAll(),
        ]);
    }

    /**
     * @param ProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productRepository
            ->create($request->validated());

        return redirect(route('products.index'))
            ->with('success', __('messages.created_success', [
                'name' => $this->name,
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
            'product' => $this->productRepository
                ->findById($productId),
            'categories' => $this->categoryRepository
                ->getAll(),
            'producers' => $this->producerRepository
                ->getAll(),
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
        $product = $this->productRepository
            ->findById($productId);
        $product->update($request->validated());

        return redirect(route('products.index'))
            ->with('success', __('messages.updated_success', [
                'name' => $this->name,
            ]));
    }

    /**
     * @param int $productId
     *
     * @return RedirectResponse
     */
    public function destroy(int $productId): RedirectResponse
    {
        $product = $this->productRepository
            ->findById($productId);
        $product->delete();

        return redirect(route('products.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
