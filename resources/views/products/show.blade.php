@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1>Product: "{{$product->name}}"</h1>
        <p>Category of product: <a href="{{ route('categories.show', $product->category->id) }}">
                {{$product->category->name}}</a></p>
        <p>Producer: <a href="{{ route('producers.show', $product->producer->id) }}">
                {{$product->producer->name}}</a></p>
        <p>Description: {{$product->description}}</p>
        <p>Price: <span id="base-price">{{$product->price}}</span></p>

        <h3>Select additional services:</h3>
        <form id="service-form">
            @foreach($services as $service)
                <div>
                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                           data-price="{{ $service->price }}" onchange="calculatePrice()">
                    {{ $service->name }} (+{{ $service->price }})
                </div>
            @endforeach
        </form>

        <p>Total Price: <span id="total-price">{{$product->price}}</span></p>

        <button class="btn btn-primary" id="total-price-btn">
            Total Price: {{$product->price}}
        </button>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete {{$product->name}} product</button>
        </form>
    </section>

    <a href="{{ route('products.index') }}"> Return to all products</a>

    <script>
        function calculatePrice() {
            let basePrice = parseFloat(document.getElementById('base-price').innerText);
            let totalPrice = basePrice;
            document.querySelectorAll('input[name="services[]"]:checked').forEach(checkbox => {
                totalPrice += parseFloat(checkbox.dataset.price);
            });

            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
            document.getElementById('total-price-btn').innerText = "Total Price: " + totalPrice.toFixed(2);
        }
    </script>
@endsection
