@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>User: "{{$user->name}}"</h1>

        <p>Email: {{$user->email}}</p>

        <p>Role: {{$user->role->name}}</p>

        <div class="d-flex" style="gap: 30px">
            <form action="{{ route('admin.users.edit', $user->id) }}" method="GET">
                <button type="submit" class="btn btn-primary">Edit User</button>
            </form>

            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete User</button>
            </form>
        </div>


    </section>

    <a href="{{ route('admin.users.index') }}"> Return to all users</a>
@endsection
