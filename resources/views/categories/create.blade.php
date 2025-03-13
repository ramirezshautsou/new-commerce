@extends('layouts.app')

@section('title', 'Add category')

@section('content')
    <div class="container mt-5">
        <h2>Create new category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product name" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" required>
            </div>

            <button type="submit" class="btn btn-primary">Create category</button>
        </form>
    </div>
@endsection
