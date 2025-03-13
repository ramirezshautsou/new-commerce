@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}">Create new category</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($categories as $category)
            @include('categories._card', ['category' => $category])
        @endforeach
    </section>
@endsection
