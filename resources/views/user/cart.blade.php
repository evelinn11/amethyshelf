@extends('user.base.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
@endpush

@section('content')
    <div class="wishlist-container container mt-4">
        <h2>My Cart</h2>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($cartItems->isNotEmpty())
            {{-- Desktop Table --}}
            <div class="table-responsive">
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
                                $subtotal = $item->cart_details_price * $item->cart_details_amount;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td><img src="{{ asset($item->product->primaryImage->product_images_url) }}"
                                        alt="{{ $item->product->products_title }}" width="60"></td>
                                <td>{{ $item->product->products_title }}</td>
                                <td>{{ $item->product->products_author_name }}</td>
                                <td>Rp {{ number_format($item->cart_details_price, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        style="display: flex; align-items: center;">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" name="action" value="decrement"
                                            class="btn btn-sm btn-light">-</button>

                                        <input type="number" name="quantity" value="{{ $item->cart_details_amount }}"
                                            min="1"
                                            style="width: 50px; text-align: center; margin: 0 5px;"
                                            onchange="this.form.submit()">

                                        <button type="submit" name="action" value="increment"
                                            class="btn btn-sm btn-light">+</button>
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
            </div>

            {{-- Mobile List --}}
            <div class="cart-mobile-list d-block d-md-none">
                @foreach ($cartItems as $item)
                    @php
                        $subtotal = $item->cart_details_price * $item->cart_details_amount;
                    @endphp
                    <div class="cart-mobile-item">
                        <img src="{{ asset($item->product->primaryImage->product_images_url) }}"
                            alt="{{ $item->product->products_title }}">
                        <div class="cart-mobile-details">
                            <h5>{{ $item->product->products_title }}</h5>
                            <p>Author: {{ $item->product->products_author_name }}</p>
                            <p>Price: Rp {{ number_format($item->cart_details_price, 0, ',', '.') }}</p>
                            <div class="cart-mobile-qty-remove">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" name="action" value="decrement" class="btn btn-light btn-sm">-</button>

                                    <input type="number" name="quantity" value="{{ $item->cart_details_amount }}" min="1">

                                    <button type="submit" name="action" value="increment" class="btn btn-light btn-sm">+</button>
                                </form>

                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Total dan Checkout Footer di mobile --}}
            <div class="cart-mobile-footer d-flex d-md-none">
                <h4 class="total-mobile">Total: <span class="text-purple">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-purple">Checkout</button>
                </form>
            </div>

            {{-- Total dan Checkout desktop --}}
            <div class="d-none d-md-flex justify-content-between align-items-center mt-4">
                <h4 class="text-purple">Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-purple">Checkout</button>
                </form>
            </div>

        @else
            <div class="alert alert-info mt-3">Your cart is empty.</div>
        @endif
    </div>
@endsection