@extends('layouts.app')

@section('title', 'Add service')

@section('content')
    <div class="container mt-5">
        <h2>Create new service</h2>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Service name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Service name" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" required>
            </div>

            <div class="mb-3">
                <label for="target_date" class="form-label">Target date</label>
                <input type="date" class="form-control" id="target_date" name="target_date">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" step="0.01">
            </div>

            <button type="submit" class="btn btn-primary">Create service</button>
        </form>
    </div>
@endsection
