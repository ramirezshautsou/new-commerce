@extends('layouts.app')

@section('title', $service->name)

@section('content')
    <section class="mt-3 py-5 container">
        <h1>Service: "{{ $service->name }}"</h1>
        <p><strong>Price:</strong> {{ number_format($service->price, 2) }} BYN</p>

        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete service</button>
        </form>
    </section>


    <div class="text-center mt-4">
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary" style="text-decoration: none; color: #007bff;">Return to all services</a>
    </div>

    <style>
        .btn-outline-secondary {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #0056b3;
            color: white;
            border-color: #0056b3;
        }
    </style>
@endsection
