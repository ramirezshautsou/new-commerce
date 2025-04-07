<?php

namespace App\View\Composers;

use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductComposer extends BaseComposer
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProducerRepositoryInterface $producerRepository
     * @param ServiceRepositoryInterface $serviceRepository
     * @param ProductService $productService
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProducerRepositoryInterface $producerRepository,
        protected ServiceRepositoryInterface $serviceRepository,
        protected ProductService $productService,
    ) {
        parent::__construct([
            'producers' => $producerRepository,
            'categories' => $categoryRepository,
            'services' => $serviceRepository,
        ]);
    }

    public function compose(View $view): void
    {
        parent::compose($view);

        $productId = request()->route('productId');

        if ($productId && is_numeric($productId)) {
            $view->with('product', $this->productService->getProductById($productId));
        }
    }
}
