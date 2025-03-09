@extends('layouts.app')

@section('title', 'Market')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Product market with best prices</h1>
        <a href="{{ route('products.index') }}">Here you can check all the products</a>
    </section>
@endsection
