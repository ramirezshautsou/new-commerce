@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>{{$product->name}}</h1>
        <p>Описание: {{$product->description}}</p>
        <p>Цена: {{$product->price}}</p>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
        </form>

        <a href="{{ route('products.index') }}"> Return to all products</a>
    </section>
@endsection
