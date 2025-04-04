@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Products</h1>

        <div class="mb-4">
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
                                ID
                            </a>
                        </th>
                    @endif
                @endauth
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Name
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'category_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Category
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'producer_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Producer
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Price
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
                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
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
