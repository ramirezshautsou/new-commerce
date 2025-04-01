@extends('layouts.app')

@section('title', 'Currency')

@section('content')
    <section class="mt-7 py-5 text-center container">
        <h1>Only actual currency</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Currency</th>
            <th>Rate</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rates as $currency => $rate)
            <tr>
                <td>{{ $currency }}</td>
                <td>{{ $rate }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="{{ url('admin/currency-rates/update') }}" method="POST">
        @csrf
        <button type="submit">Update Currency Rates</button>
    </form>
    </section>
@endsection
