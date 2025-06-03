@extends('user.base.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/wishlist.css') }}">
@endpush

@section('content')

    <div class="wishlist-container container mt-4">
        <h2>My Wishlist</h2>

        @if (!empty($wishlist) && count($wishlist) > 0)
            <table class="table table-bordered">
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
                            <td><img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" width="60"></td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['author'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('wishlist.remove', $index) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="product_name" value="{{ $item['title'] }}">
                                    <input type="hidden" name="product_author" value="{{ $item['author'] }}">
                                    <input type="hidden" name="product_price" value="{{ $item['price'] }}">
                                    <button type="submit" class="btn btn-sm btn-purple" title="Add to Cart">Add to Cart</button>
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

<script>
    function removeRow(button) {
        if (!confirm('Are you sure you want to remove this item from your wishlist?')) return;
        const row = button.closest('tr');
        row.remove();
    }
</script>
