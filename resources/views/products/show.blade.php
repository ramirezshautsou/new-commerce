@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>{{$product->name}}</h1>
        <p>Описание: {{$product->description}}</p>
        <p>Цена: {{$product->price}}</p>
        <a href="{{ route('products.index') }}"> Return to all products</a>
    </section>
@endsection
