<div class="col">
    <div class="card shadow-lg rounded-3">
        <!-- Добавим изображение продукта -->
        <img src="{{ $product->image_url }}" class="card-img-top rounded-3" alt="{{ $product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ \Str::limit($product->description, 100) }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('products.show', $product->id) }}"
                       class="btn btn-sm btn-primary rounded-3 shadow-sm">View</a>
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="btn btn-sm btn-secondary rounded-3 shadow-sm">Edit</a>
                </div>
                <small class="text-body-secondary fs-6">{{ $product->price }} BYN</small>
            </div>
        </div>
    </div>
</div>
