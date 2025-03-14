@extends('layouts.app')

@section('title', 'Service types')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Service types</h1>
        <a href="{{ route('service-types.create') }}">Create new service type</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($serviceTypes as $serviceType)
            @include('service-types._card', ['serviceType' => $serviceType])
        @endforeach
    </section>
@endsection
