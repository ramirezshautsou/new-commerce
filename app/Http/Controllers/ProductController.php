<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     *
     */
    private const PAGE_LIMIT = 15;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProducerRepositoryInterface $producerRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, ProducerRepositoryInterface $producerRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->producerRepository = $producerRepository;
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
            'categories' => $this->productRepository->getAll(),
            'producers' => $this->producerRepository->getAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $product = $this->productRepository->create($request->only([
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
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $product = $this->productRepository->findById($id);

        return view('products.show', compact('product'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $product = $this->productRepository->findById($id);
        $categories = $this->categoryRepository->getAll();
        $producers = $this->producerRepository->getAll();

        return view('products.edit', compact('product', 'categories', 'producers'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $product = $this->productRepository->findById($id);

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
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = $this->productRepository->findById($id);
        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }
}
