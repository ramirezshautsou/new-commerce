@extends('layouts.app')

@section('title', 'Add product')

@section('content')
    <div class="container mt-7">
        <h2 class="mb-4">Add a new product</h2>

        <form action="{{ route('products.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias:</label>
                <input type="text" id="alias" name="alias" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Let's go</button>
        </form>
        <a href="{{route('products.index')}}">Going back to all products</a>
    </div>
@endsection
