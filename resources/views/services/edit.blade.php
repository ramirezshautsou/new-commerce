@extends('layouts.app')

@section('title', 'Edit ' . $service->name . ' service')

@section('content')
    <div class="container my-5">
        <h2>Edit service</h2>
        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Service name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $service->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias"
                       value="{{ old('alias', $service->alias) }}" required>
            </div>

            <div class="mb-3">
                <label for="target_date" class="form-label">Target date</label>
                <input type="date" class="form-control" id="target_date" name="target_date"
                       value="{{ old('target_date', $service->target_date) }}">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                       value="{{ old('price', $service->price) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update service</button>
        </form>
    </div>
@endsection
