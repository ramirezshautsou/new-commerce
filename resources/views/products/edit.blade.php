@extends('layouts.app')

@section('title', 'Edit ' . $product->name . ' product')

@section('content')
    <div class="container my-5">
        <h2>Edit product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias"
                       value="{{ old('alias', $product->alias) }}" required>
            </div>

            <div class="mb-3">
                <label for="producer_id" class="form-label">Producer</label>
                <select class="form-control" id="producer_id" name="producer_id" required>
                    @foreach($producers as $producer)
                        <option value="{{ $producer->id }}"
                            {{ $producer->id == old('producer_id', $product->producer_id) ? 'selected' : '' }}>
                            {{ $producer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="production_date" class="form-label">Production date</label>
                <input type="date" class="form-control" id="production_date" name="production_date"
                       value="{{ old('production_date', $product->production_date) }}">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                       value="{{ old('price', $product->price) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description"
                          name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update product</button>
        </form>
    </div>
@endsection
