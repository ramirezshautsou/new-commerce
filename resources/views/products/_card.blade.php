<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>{{ $product->name }}</h2>
            <p class="card-text">{{ $product->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Delete</a>
                </div>
                <small class="text-body-secondary">{{ $product->price }} BYN</small>
            </div>
        </div>
    </div>
</div>
