<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{

    public function all(): Collection
    {
        return Product::all();
    }

    public function findById($id): Product
    {
       return Product::query()->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function update($id, array $data): Product
    {
        $product = Product::query()->findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id): bool
    {
        return Product::destroy($id) > 0;
    }

    public function paginate($limitPerPage = 15): LengthAwarePaginator
    {
        return Product::query()->paginate($limitPerPage);
    }
}
