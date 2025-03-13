@extends('layouts.app')

@section('title', 'Edit ' . $producer->name . ' producer')

@section('content')
    <div class="container mt-5">
        <h2>Edit producer</h2>
        <form action="{{ route('producers.update', $producer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Producer name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $producer->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias"
                       value="{{ old('alias', $producer->alias) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update producer</button>
        </form>
    </div>
@endsection
