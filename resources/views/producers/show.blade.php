@extends('layouts.app')

@section('title', $producer->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>Producer: "{{$producer->name}}"</h1>
        <h3>Products from this producer:</h3>
        <ol>
            @foreach($producer->products as $product)
                <li>
                    <strong>
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </strong> - {{$product->price}} BYN
                    <p>{{ $product->description }}</p>
                </li>
            @endforeach
        </ol>
        @auth
            @if(auth()->user()?->role->name === 'admin')
                <form action="{{ route('producers.destroy', $producer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                        Delete {{$producer->name}} producer
                    </button>
                </form>
            @endif
        @endauth
    </section>

    <a href="{{ route('producers.index') }}"> Return to all producers</a>
@endsection
