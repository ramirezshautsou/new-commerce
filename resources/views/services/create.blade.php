@extends('layouts.app')

@section('title', 'Add service')

@section('content')
    <div class="container mt-5 py-3">
        <h2>Create new service</h2>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Service name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Service name" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control @error('alias') is-invalid @enderror" id="alias" name="alias" placeholder="Alias" required>
                @error('alias')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="target_date" class="form-label">Target date</label>
                <input type="date" class="form-control @error('target_date') is-invalid @enderror" id="target_date" name="target_date">
                @error('target_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" step="0.01">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Create service</button>
        </form>
    </div>
@endsection
