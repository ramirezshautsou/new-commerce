@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>Category: "{{$category->name}}"</h1>
        <h3>Products in this category:</h3>
        <ol>
            @foreach($category->products as $product)
                <li>
                    <strong>
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </strong> - {{$product->price}} BYN
                    <p>{{ $product->description }}</p>
                </li>
            @endforeach
        </ol>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete {{$category->name}} category</button>
        </form>
    </section>

    <a href="{{ route('categories.index') }}"> Return to all categories</a>
@endsection
