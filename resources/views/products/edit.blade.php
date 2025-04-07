@extends('layouts.app')

@section('title', 'Edit ' . $product->name . ' Product')

@section('content')
    <div class="container my-5 py-3">
        <h2>Edit Product</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                       value="{{ old('name', $product->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control @error('alias') is-invalid @enderror" id="alias" name="alias"
                       value="{{ old('alias', $product->alias) }}" required>
                @error('alias')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="producer_id" class="form-label">Producer</label>
                <select class="form-select @error('producer_id') is-invalid @enderror" id="producer_id" name="producer_id" required>
                    @foreach($producers as $producer)
                        <option value="{{ $producer->id }}"
                            {{ $producer->id == old('producer_id', $product->producer_id) ? 'selected' : '' }}>
                            {{ $producer->name }}
                        </option>
                    @endforeach
                </select>
                @error('producer_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="production_date" class="form-label">Production Date</label>
                <input type="date" class="form-control @error('production_date') is-invalid @enderror" id="production_date" name="production_date"
                       value="{{ old('production_date', $product->production_date) }}">
                @error('production_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01"
                       value="{{ old('price', $product->price) }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                          name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
