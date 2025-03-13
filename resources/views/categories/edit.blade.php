@extends('layouts.app')

@section('title', 'Edit ' . $category->name . ' category')

@section('content')
    <div class="container mt-5">
        <h2>Edit category</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias"
                       value="{{ old('alias', $category->alias) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update category</button>
        </form>
    </div>
@endsection
