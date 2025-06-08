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
            <table class="table table-bordered wishlist-table">
                <thead class="table-secondary">
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlist as $index => $item)
                        <tr>
                            <td data-label="Cover">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" width="60">
                            </td>
                            <td data-label="Title">
                                {{ $item['title'] }}
                            </td>
                            <td data-label="Author">
                                {{ $item['author'] }}
                            </td>
                            <td data-label="Price">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </td>
                            <td data-label="Remove">
                                <form action="{{ route('wishlist.remove', $index) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                            <td data-label="Add to Cart">
                                <form action="{{ route('wishlist.moveToCart', ['index' => $index]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-purple">
                                        Add to Cart
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">Wishlist kamu masih kosong.</div>
        @endif
    </div>

@endsection

{{-- @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-ajax').click(function(e) {
                e.preventDefault();

                const button = $(this);
                const title = button.data('name');
                const author = button.data('author');
                const price = button.data('price');

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: {
                        product_name: title,
                        product_author: author,
                        product_price: price,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Produk berhasil ditambahkan ke keranjang!');
                        if (response.cart_count !== undefined) {
                            $('.cart-count').text(response.cart_count).show();
                        }
                    },
                    error: function() {
                        alert('Gagal menambahkan produk ke keranjang.');
                    }
                });
            });
        });
    </script>
@endpush --}}
