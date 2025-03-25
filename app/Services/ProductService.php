<?php

namespace App\Services;

use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    ) {}

    public function getFilteredProducts(array $filters, string $sortBy, string $sortOrder, int $limit): LengthAwarePaginator
    {
        $query = $this->productRepository
            ->filter($filters);

        return $this->productRepository
            ->sort($query, [
                'field' => $sortBy,
                'direction' => $sortOrder,
            ])->paginate($limit);
    }

    public function getProductById(int $productId): Model
    {
        return $this->productRepository->findById($productId);
    }

    public function createProduct(array $data): Model
    {
        return $this->productRepository
            ->create($data);
    }

    public function updateProduct(int $productId, array $data): Model
    {
        $product = $this->getProductById($productId);
        $product->update($data);

        return $product;
    }

    public function deleteProduct(int $productId): void
    {
        $product = $this->getProductById($productId);
        $product->delete();
    }
}
