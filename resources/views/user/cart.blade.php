@extends('user.base.base')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
@endpush

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('content')
    <div class="wishlist-container container mt-4">
        <h2>My Cart</h2>

        @if($cartItems->isNotEmpty())
            <table class="table table-bordered cart-table">
                <thead class="table-secondary">
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php
                            // Menghitung subtotal dengan field yang sesuai
                            $subtotal = $item->cart_details_price * $item->cart_details_amount;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td><img src="{{ asset('storage/'.$item->product->primaryImage->product_images_path) }}" alt="{{ $item->product->products_title }}" width="60"></td>
                            <td>{{ $item->product->products_title }}</td>
                            <td>{{ $item->product->products_author_name }}</td>
                            <td>Rp {{ number_format($item->cart_details_price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: flex; align-items: center;">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" name="action" value="decrement" class="btn btn-sm btn-light">-</button>

                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ $item->cart_details_amount }}" 
                                        min="1" 
                                        style="width: 50px; text-align: center; margin: 0 5px;"
                                        onchange="this.form.submit()"
                                    >

                                    <button type="submit" name="action" value="increment" class="btn btn-sm btn-light">+</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4>Total: <span class="text-purple">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-purple">Checkout</button>
                </form>
            </div>
        @else
            <div class="alert alert-info">Keranjang kamu masih kosong.</div>
        @endif
    </div>
@endsection

<style>
    body {
        background-color: #f8f3ff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .text-purple {
        color: #6c33ff;
        font-weight: 700;
    }
    .btn-purple {
        background-color: #b497ff;
        color: #2e2e2e;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-purple:hover {
        background-color: #7a49ff;
        color: white;
    }
    .btn-purple-outline {
        background-color: transparent;
        border: 2px solid #b497ff;
        color: #6c33ff;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-purple-outline:hover {
        background-color: #6c33ff;
        color: white;
        border-color: #6c33ff;
    }
    .cart-table tbody tr:hover {
        background-color: #f0e9ff;
    }
</style>