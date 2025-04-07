<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    ) {}

    /**
     * @param array $filters
     * @param string $sortBy
     * @param string $sortOrder
     * @param int $limit
     *
     * @return LengthAwarePaginator
     */
    public function getFilteredProducts(
        array  $filters,
        string $sortBy,
        string $sortOrder,
        int    $limit,
    ): LengthAwarePaginator
    {
        $query = $this->productRepository
            ->filter($filters);

        return $this->productRepository
            ->sort($query, [
                'field' => $sortBy,
                'direction' => $sortOrder,
            ])
            ->paginate($limit);
    }

    /**
     * @param int $productId
     *
     * @return Product
     */
    public function getProductById(int $productId): Product
    {
        return $this->productRepository->findById($productId);
    }

    /**
     * @param array $data
     *
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    /**
     * @param int $productId
     * @param array $data
     *
     * @return Product
     */
    public function updateProduct(int $productId, array $data): Product
    {
        $product = $this->getProductById($productId);
        $product->update($data);

        return $product;
    }

    /**
     * @param int $productId
     *
     * @return void
     */
    public function deleteProduct(int $productId): void
    {
        $product = $this->getProductById($productId);
        $product->delete();
    }

    /**
     * @param int $productId
     *
     * @return float
     */
    public function getProductPrice(int $productId): float
    {
        return $this->productRepository->price($productId);
    }
}
