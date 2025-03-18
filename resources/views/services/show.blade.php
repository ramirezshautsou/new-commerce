@extends('layouts.app')

@section('title', $service->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>Service: "{{$service->name}}"</h1>
        <p>Price: {{$service->price}}</p>

        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete {{$service->name}} service</button>
        </form>
    </section>

    <a href="{{ route('services.index') }}"> Return to all services</a>
@endsection
