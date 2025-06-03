@extends('user.base.base')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/user/products.css') }}"> --}}

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }

        .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content-wrapper {
            padding: 0 24px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            justify-items: center;
        }

        .product-card {
            position: relative;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
            padding: 30px;
            width: 100%;
            max-width: 300px;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Pastikan max-width tidak terlalu besar */
            box-sizing: border-box;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-card img {
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            height: 300px;
            object-fit: cover;
            /* border-radius: 12px; */
            display: block;

        }

        .product-actions {
            position: absolute;
            top: 16px;
            right: 16px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-actions {
            opacity: 1;
        }

        .product-icon,
        .product-icon a,
        .product-icon i {
            color: white;
        }

        .product-icon {
            background-color: #a78bfa;
            /* color: white; */
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-icon:hover {
            background-color: #7c3aed;
            /* color: white; */
        }

        .product-title {
            font-weight: bold;
            font-size: 18px;
            margin-top: 40px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 20px;
            /* ini penting untuk menyamakan tinggi */

        }

        .product-author {
            font-style: italic;
            color: gray;
            margin-top: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            color: #10b981;
            font-weight: bold;
            font-size: 16px;
            margin-top: 8px;
        }

        .product-description {
            margin-top: 8px;
            color: #444;
        }

        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
        }

        .product-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
    </style>
@endpush



@section('content')
    <div class="content-wrapper" style="margin-top: 24px;">
        <h2>Product's Category: {{ $category->categories_name }}</h2>

        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" class="product-link">
                        {{-- <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->products_title }}" class="product-image"> --}}

                        <img src="{{ asset($product->primaryImage->product_images_url) }}"
                            alt="{{ $product->products_title }}" class="product-image">
                    </a>

                    <div class="product-actions">
                        {{-- Wishlist --}}
                        @php
                            $wishlist = session('wishlist', []);
                            $inWishlist = collect($wishlist)->contains('title', $product->products_title);
                        @endphp

                        <form action="{{ route('wishlist.toggle') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ $product->products_title }}">
                            <input type="hidden" name="product_author" value="{{ $product->products_author_name }}">
                            <input type="hidden" name="product_price" value="{{ $product->products_price }}">
                            <input type="hidden" name="product_image"
                                value="{{ $product->primaryImage->product_images_url }}">

                            <button type="submit" class="product-icon" title="Wishlist">
                                <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart" style="color: {{ $inWishlist ? '#e3342f' : '#ffffff' }}"></i>
                            </button>
                        </form>

                        {{-- Cart --}}
                        <div class="product-icon" title="Tambah ke Keranjang">
                            <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_name" value="{{ $product->products_title }}">
                                <input type="hidden" name="product_author" value="{{ $product->products_author_name }}">
                                <input type="hidden" name="product_price" value="{{ $product->products_price }}">
                                <input type="hidden" name="product_image"
                                    value="{{ $product->primaryImage->product_images_url }}">
                                <button type="submit" class="product-icon" title="Tambah ke Keranjang">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('product.show', $product->id) }}" class="product-link"
                        style="text-decoration: none;">
                        <div class="product-title">{{ $product->products_title }}</div>
                        <div class="product-author">By {{ $product->products_author_name }}</div>
                        <div class="product-price">Rp{{ number_format($product->products_price, 0, ',', '.') }}</div>
                    </a>
                </div>
            @empty
                <p>There's no product in this category.</p>
            @endforelse
        </div>
    </div>
@endsection
