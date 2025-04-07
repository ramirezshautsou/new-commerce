@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="mt-5 py-5 text-center container" style="">
        <h1 class="mb-4">Products</h1>

        <div class="mb-4 p-4 border rounded shadow-sm" style="background-color: #f9f9f9;">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="categories" id="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('categories') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="producer" class="form-label">Producer</label>
                        <select name="producers" id="producer" class="form-select">
                            <option value="">All Producers</option>
                            @foreach($producers as $producer)
                                <option value="{{ $producer->id }}"
                                    {{ request('producers') == $producer->id ? 'selected' : '' }}>
                                    {{ $producer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="price_min" class="form-label">Min Price</label>
                        <input type="number" name="price_min" id="price_min" class="form-control"
                               value="{{ request('price_min') }}">
                    </div>

                    <div class="col-md-2">
                        <label for="price_max" class="form-label">Max Price</label>
                        <input type="number" name="price_max" id="price_max" class="form-control"
                               value="{{ request('price_max') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4 w-100">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        @if($products->isEmpty())
            <div class="alert alert-warning" role="alert">
                No products found based on the selected filters.
            </div>
        @endif

        @auth
            @if(auth()->user()?->role->name === 'admin')
                <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create Product</a>
            @endif
        @endauth

        <table class="table table-striped">
            <thead>
            <tr>
                @auth
                    @if(auth()->user()?->role->name === 'admin')
                        <th>
                            <a href="{{ route('products.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                                ID <i class="bi {{ request('sort_by') == 'id' ? (request('sort_order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down') : 'bi-arrow-down-up' }}"></i>
                            </a>
                        </th>
                    @endif
                @endauth
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Name <i class="bi {{ request('sort_by') == 'name' ? (request('sort_order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down') : 'bi-arrow-down-up' }}"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'category_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Category <i class="bi {{ request('sort_by') == 'category_id' ? (request('sort_order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down') : 'bi-arrow-down-up' }}"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'producer_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Producer <i class="bi {{ request('sort_by') == 'producer_id' ? (request('sort_order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down') : 'bi-arrow-down-up' }}"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Price <i class="bi {{ request('sort_by') == 'price' ? (request('sort_order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down') : 'bi-arrow-down-up' }}"></i>
                    </a>
                </th>
                @auth
                    @if(auth()->user()?->role->name === 'admin')
                        <th>Actions</th>
                    @endif
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    @auth
                        @if(auth()->user()?->role->name === 'admin')
                            <td>{{ $product->id }}</td>
                        @endif
                    @endauth
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="product-link">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->producer->name ?? 'N/A' }}</td>
                    <td>{{ $product->price }} BYN</td>
                    @auth
                        @if(auth()->user()?->role->name === 'admin')
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
@endsection

<style>
    .product-link {
        text-decoration: none;
        color: #007bff;
        position: relative;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .product-link:hover {
        color: #0056b3;
        transform: scale(1.05);
    }

    .product-link::after {
        content: ' →';
        font-size: 0.9em;
        color: #007bff;
    }

    .product-link:hover::after {
        content: ' ←';
        color: #0056b3;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table a {
        color: inherit;
        text-decoration: none;
    }

    .btn-outline-secondary {
        font-size: 1.1rem;
        padding: 10px 20px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #0056b3;
        color: white;
        border-color: #0056b3;
    }

    .btn-primary {
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white;
    }

    .alert-warning {
        border-radius: 8px;
    }
</style>
