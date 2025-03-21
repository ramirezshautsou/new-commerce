@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Users</h1>
        <a href="{{ route('admin.users.create') }}">Create new user</a>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($users as $user)
            @include('admin.users._card', ['user' => $user])
        @endforeach
    </section>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
@endsection

