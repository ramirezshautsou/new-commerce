@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Products</h1>
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
                        <td>
                        <th>
                            <a href="{{ route('products.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                                ID
                            </a>
                        </th>
                    @endif
                @endauth
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'category_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Category
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'producer_id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                        Producer
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort_by' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
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
                    <td>{{ $product->price }}</td>
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
