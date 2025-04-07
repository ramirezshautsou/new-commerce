@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="mt-7 py-5 container">
        <h1 class="text-center mb-4">Product: "{{$product->name}}"</h1>

        <div class="mb-4 p-4 border rounded shadow-sm" style="background-color: #f9f9f9;">
            <p class="lead">Category of product:
                <a href="{{ route('categories.show', $product->category->id) }}" class="btn btn-link text-dark product-link">
                    {{ $product->category->name }}
                </a>
            </p>
            <p class="lead">Producer:
                <a href="{{ route('producers.show', $product->producer->id) }}" class="btn btn-link text-dark product-link">
                    {{ $product->producer->name }}
                </a>
            </p>
            <p class="lead">Description: {!! nl2br(e($product->description)) !!}</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="h5 mb-0">
                Price: <span id="price">{{ number_format($product->price, 2) }}</span> <span id="currency">BYN</span>
            </p>
            <div>
                <button onclick="changeCurrency('BYN', {{ $product->price }})" class="btn btn-outline-primary me-2">BYN</button>
                <button onclick="changeCurrency('USD', {{ $convertedPrices['USD'] }})" class="btn btn-outline-primary me-2">USD</button>
                <button onclick="changeCurrency('EUR', {{ $convertedPrices['EUR'] }})" class="btn btn-outline-primary me-2">EUR</button>
                <button onclick="changeCurrency('RUB', {{ $convertedPrices['RUB'] }})" class="btn btn-outline-primary">RUB</button>
            </div>
        </div>

        <h3>Select additional services:</h3>
        <form id="service-form" class="mb-4">
            @foreach($services as $service)
                <div class="form-check">
                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                           data-price="{{ $service->price }}" class="form-check-input" onchange="calculatePrice()">
                    <label class="form-check-label">{{ $service->name }} (+ {{ number_format($service->price, 2) }} BYN)</label>
                </div>
            @endforeach
        </form>

        <p>Total Price: <span id="total-price">{{ number_format($product->price, 2) }}</span> BYN</p>

        <button class="btn btn-success btn-lg" id="total-price-btn">
            Total Price: {{ number_format($product->price, 2) }} BYN
        </button>

        @auth
            @if(auth()->user()?->role->name === 'admin')
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-3">Delete {{$product->name}} product</button>
                </form>
            @endif
        @endauth
    </section>

    <div class="text-center mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Return to all products</a>
    </div>

    <script>
        function calculatePrice() {
            let basePrice = parseFloat(document.getElementById('price').innerText.replace(',', ''));
            let totalPrice = basePrice;
            document.querySelectorAll('input[name="services[]"]:checked').forEach(checkbox => {
                totalPrice += parseFloat(checkbox.dataset.price);
            });

            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
            document.getElementById('total-price-btn').innerText = "Total Price: " + totalPrice.toFixed(2);
        }

        function changeCurrency(currency, price) {
            document.getElementById('price').innerText = price.toFixed(2);
            document.getElementById('currency').innerText = currency;
        }
    </script>

    <style>
        .product-link {
            position: relative;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .product-link:hover {
            color: #0056b3;
            transform: scale(1.05);
        }

        .product-link::after {
            content: ' →';
            font-size: 0.9em;
            color: #007bff;
        }

        .product-link:hover::after {
            content: ' ←';
            color: #0056b3;
        }

        .btn-outline-secondary {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #0056b3;
            color: white;
            border-color: #0056b3;
        }
    </style>
@endsection
