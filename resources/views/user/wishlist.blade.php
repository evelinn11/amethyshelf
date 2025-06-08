@extends('user.base.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/wishlist.css') }}">
@endpush

@section('content')

<div class="wishlist-container container mt-4">
    <h2>My Wishlist</h2>

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

    @if (!empty($wishlist) && count($wishlist) > 0)
        {{-- Desktop View --}}
        <table class="table table-bordered wishlist-table d-none d-md-table">
            <thead class="table-secondary">
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Remove</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlist as $index => $item)
                    <tr>
                        <td data-label="Cover">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" width="60">
                        </td>
                        <td data-label="Title">{{ $item['title'] }}</td>
                        <td data-label="Author">{{ $item['author'] }}</td>
                        <td data-label="Price">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td data-label="Remove">
                            <form action="{{ route('wishlist.remove', $index) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                        <td data-label="Add to Cart">
                            <form action="{{ route('wishlist.moveToCart', ['index' => $index]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-purple">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Mobile View --}}
        <div class="wishlist-mobile-list d-md-none">
            @foreach ($wishlist as $index => $item)
                <div class="wishlist-mobile-item">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <div class="wishlist-mobile-details">
                        <h5>{{ $item['title'] }}</h5>
                        <p>Author: {{ $item['author'] }}</p>
                        <p>Price: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <div class="wishlist-mobile-buttons">
                            <form action="{{ route('wishlist.remove', $index) }}" method="POST"
                                  onsubmit="return confirm('Remove this item from your wishlist?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                            <form action="{{ route('wishlist.moveToCart', ['index' => $index]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-purple btn-sm">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Wishlist kamu masih kosong.</div>
    @endif
</div>

@endsection