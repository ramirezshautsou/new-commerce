@extends('layouts.app')

@section('title', 'Market')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Product market with best prices</h1>
        <div class="d-flex gap-3" style="align-items: center; justify-content: center">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Check all products</a>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Check all categories</a>
            <a href="{{ route('producers.index') }}" class="btn btn-primary">Check all producers</a>
            <a href="{{ route('services.index') }}" class="btn btn-primary">Check all services</a>
        </div>
    </section>
@endsection
