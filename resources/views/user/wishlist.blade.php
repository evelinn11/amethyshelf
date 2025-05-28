@extends('user.base.base')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
@endpush

@section('content')
<div class="container py-4" style="min-height: 70vh;">
    <h3 class="my-4">My Wishlist</h3>

    <div id="success-message" class="alert alert-success d-none" role="alert">
        Add to cart successful!
    </div>

    @php
        $wishlist = [
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'price' => 100000,
                'image' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'price' => 200000,
                'image' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
            ],
        ];
    @endphp

    @if (count($wishlist) === 0)
        <div class="alert alert-info text-center">Your wishlist is empty.</div>
    @else
    <div class="table-responsive">
        <table class="table cart-table shadow-sm">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlist as $item)
                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" width="60" height="80" />
                            <div>
                                <div class="fw-semibold">{{ $item['title'] }}</div>
                                <div class="text-muted small">By {{ $item['author'] }}</div>
                            </div>
                        </td>
                        <td class="align-middle">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="align-middle">
                            <div class="gap-2 no-wrap-buttons">
                                <button class="btn btn-primary" onclick="addToCart(this)">Add To Cart</button>
                                <span class="text-remove ms-2" onclick="removeRow(this)">Remove</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<script>
    function removeRow(el) {
        if (!confirm('Are you sure you want to remove this item from your wishlist?')) return;
        const row = el.closest('tr');
        row.remove();
    }

    function addToCart(button) {
        const row = button.closest('tr');
        row.remove();

        const message = document.getElementById('success-message');
        message.classList.remove('d-none');
        message.classList.add('show');

        setTimeout(() => {
            message.classList.add('d-none');
        }, 2000);
    }
</script>
@endsection
