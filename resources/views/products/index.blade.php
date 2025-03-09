@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}">Create new product</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($products as $product)
                @include('products._card', ['product' => $product])
        @endforeach
    </section>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
