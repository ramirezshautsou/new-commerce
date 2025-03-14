<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
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
     * @var ProducerRepositoryInterface
     */
    protected ProducerRepositoryInterface $producerRepository;

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
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ProducerRepositoryInterface $producerRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->producerRepository = $producerRepository;
        $this->name = __('entities.product');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = $this->productRepository->paginate(self::PAGE_LIMIT);

        return view('products.index', compact('products'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => $this->categoryRepository->getAll(),
            'producers' => $this->producerRepository->getAll(),
        ]);
    }

    /**
     * @param ProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->productRepository->create($validatedData);

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
    public function show(int $productId): View
    {
        $product = $this->productRepository->findById($productId);

        return view('products.show', compact('product'));
    }

    /**
     * @param int $productId
     *
     * @return View
     */
    public function edit(int $productId): View
    {
        $product = $this->productRepository->findById($productId);
        $categories = $this->categoryRepository->getAll();
        $producers = $this->producerRepository->getAll();

        return view('products.edit', compact('product', 'categories', 'producers'));
    }

    /**
     * @param ProductRequest $request
     * @param int $productId
     *
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, int $productId): RedirectResponse
    {
        $product = $this->productRepository->findById($productId);

        $validatedData = $request->validated();

        $product->update($validatedData);
        // lang
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
        $product = $this->productRepository->findById($productId);
        $product->delete();

        return redirect(route('products.index'))
            ->with('success', __('messages.deleted_success', [
                'name' => $this->name,
            ]));
    }
}
