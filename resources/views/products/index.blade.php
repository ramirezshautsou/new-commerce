@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Products</h1>

        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create Product</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'category', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Category
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Price
                    </a>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
@endsection
