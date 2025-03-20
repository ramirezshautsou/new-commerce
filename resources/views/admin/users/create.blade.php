@extends('layouts.app')

@section('title', 'Add user')

@section('content')
    <div class="container mt-5">
        <h2>Create new user</h2>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">User name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="User name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                    <option value="" disabled selected>Select a role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
