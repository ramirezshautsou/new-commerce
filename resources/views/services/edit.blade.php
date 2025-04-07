@extends('layouts.app')

@section('title', 'Edit ' . $service->name . ' service')

@section('content')
    <div class="container my-5 py-3">
        <h2>Edit service</h2>
        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">Service name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                       value="{{ old('name', $service->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control @error('alias') is-invalid @enderror" id="alias" name="alias"
                       value="{{ old('alias', $service->alias) }}" required>
                @error('alias')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="target_date" class="form-label">Target date</label>
                <input type="date" class="form-control @error('target_date') is-invalid @enderror" id="target_date" name="target_date"
                       value="{{ old('target_date', $service->target_date) }}">
                @error('target_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01"
                       value="{{ old('price', $service->price) }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Update service</button>
        </form>
    </div>
@endsection
