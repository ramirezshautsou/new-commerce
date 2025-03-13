@extends('layouts.app')

@section('title', 'Add product')

@section('content')
    <div class="container mt-5">
        <h2>Create new product</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $product->category_id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product name" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" required>
            </div>

            <div class="mb-3">
                <label for="producer_id" class="form-label">Producer</label>
                <select class="form-control" id="producer_id" name="producer_id" required>
                    @foreach($producers as $producer)
                        <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="production_date" class="form-label">Production date</label>
                <input type="date" class="form-control" id="production_date" name="production_date">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" step="0.01">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create product</button>
        </form>
    </div>
@endsection
