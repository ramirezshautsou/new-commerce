@extends('layouts.app')

@section('title', 'Add producer')

@section('content')
    <div class="container mt-5">
        <h2>Create new producer</h2>
        <form action="{{ route('producers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Producer name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Producer name" required>
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" required>
            </div>

            <button type="submit" class="btn btn-primary">Create producer</button>
        </form>
    </div>
@endsection
