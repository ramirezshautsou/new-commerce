@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create new user</a>

        <!-- Таблица пользователей -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">
                    <a href="{{ route('admin.users.index', ['sort' => 'id']) }}" class="text-decoration-none">
                        # <i class="bi bi-sort"></i>
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.users.index', ['sort' => 'name']) }}" class="text-decoration-none">
                        Name <i class="bi bi-sort"></i>
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.users.index', ['sort' => 'email']) }}" class="text-decoration-none">
                        Email <i class="bi bi-sort"></i>
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.users.index', ['sort' => 'role']) }}" class="text-decoration-none">
                        Role <i class="bi bi-sort"></i>
                    </a>
                </th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role ? $user->role->name : 'No role' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
@endsection
