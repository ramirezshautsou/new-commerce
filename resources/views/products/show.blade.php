@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>Product: "{{$product->name}}"</h1>
        <p>Category of product: <a href="{{ route('categories.show', $product->category->id) }}">{{$product->category->name}}</a></p>
        <p>Producer: <a href="{{ route('producers.show', $product->producer->id) }}">{{$product->producer->name}}</a></p>
        <p>Description: {{$product->description}}</p>
        <p>Price: {{$product->price}}</p>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete {{$product->name}} product</button>
        </form>
    </section>

    <a href="{{ route('products.index') }}"> Return to all products</a>
@endsection
