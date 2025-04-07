@extends('layouts.app')

@section('title', 'Producers')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Producers</h1>
        <a href="{{ route('producers.create') }}" class="btn btn-primary mb-4">Create new producer</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($producers as $producer)
                @include('producers._card', ['producer' => $producer])
            @endforeach
        </div>
    </section>
@endsection
