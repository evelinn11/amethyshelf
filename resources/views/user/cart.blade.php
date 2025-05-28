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
<div class="container py-4">
    <h3 class="my-4">My Cart</h3>

    @if(count($cart) === 0)
        <div class="alert alert-info text-center">Your cart is empty.</div>
    @else
    <div class="table-responsive">
        <table class="table cart-table shadow-sm">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-body">
                @php $grandTotal = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $grandTotal += $itemTotal;
                    @endphp
                    <tr data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                        <td class="d-flex align-items-center gap-3">
                            <img src="images/bumi.jpg" alt="{{ $item['name'] }}" width="60" height="80" />
                            <div>
                                <div class="fw-semibold">{{ $item['name'] }}</div>
                                <div class="text-muted small">By {{ $item['author'] ?? 'Unknown' }}</div>
                            </div>
                        </td>
                        <td class="price-cell">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            <div class="qty-controls" data-id="{{ $id }}">
                                <button class="btn-decrease" title="Decrease quantity" @if($item['quantity'] <= 1) disabled @endif>-</button>
                                <span class="qty-number">{{ $item['quantity'] }}</span>
                                <button class="btn-increase" title="Increase quantity">+</button>
                            </div>
                        </td>
                        <td class="item-total">Rp{{ number_format($itemTotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST" class="remove-form mb-0 d-flex align-items-center" style="display:inline-flex;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <span class="text-remove" onclick="handleRemove(this)">Remove</span>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-end align-items-center mt-4 gap-4 p-3 rounded" style="background-color: white;">
            <h5 class="mb-0">Grand Total:</h5>
            <h4 id="grand-total" class="text-primary mb-0">Rp{{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <form action="{{ route('cart.checkout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-primary px-4">Checkout</button>
            </form>
        </div>
    @endif
</div>
<script>
    function formatRupiah(angka) {
        return 'Rp' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi remove item
    function handleRemove(el) {
        if(!confirm('Are you sure you want to remove this item from your cart?')) {
            return;
        }
        const form = el.closest('form');
        const row = el.closest('tr');

        // Ambil harga dan qty dari atribut data untuk update grand total
        const price = Number(row.dataset.price);
        const qty = Number(row.querySelector('.qty-number').textContent);
        const subtotal = price * qty;

        // Update grand total di UI
        const grandTotalEl = document.getElementById('grand-total');
        let currentTotalText = grandTotalEl.textContent.replace(/[^0-9]/g, '');
        let currentTotal = parseInt(currentTotalText) || 0;
        let newTotal = currentTotal - subtotal;
        if(newTotal < 0) newTotal = 0;
        grandTotalEl.textContent = formatRupiah(newTotal);

        // Hapus baris dari tabel
        row.remove();

        // Submit form ke backend supaya data di session/cart juga diupdate
        form.submit();
    }

    // Update quantity dan harga
    function updateQuantity(row, newQty) {
        const price = Number(row.dataset.price);
        const qtySpan = row.querySelector('.qty-number');
        const itemTotalEl = row.querySelector('.item-total');
        const btnDecrease = row.querySelector('.btn-decrease');

        // Update qty di UI
        qtySpan.textContent = newQty;

        // Disable tombol minus jika qty 1
        btnDecrease.disabled = newQty <= 1;

        // Update harga total item
        const newItemTotal = price * newQty;
        itemTotalEl.textContent = formatRupiah(newItemTotal);

        // Update grand total
        updateGrandTotal();
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('#cart-body tr').forEach(row => {
            const price = Number(row.dataset.price);
            const qty = Number(row.querySelector('.qty-number').textContent);
            grandTotal += price * qty;
        });
        document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
    }

    // Event delegation untuk tombol quantity + dan -
    document.getElementById('cart-body').addEventListener('click', function(e){
        const target = e.target;
        if(target.classList.contains('btn-increase') || target.classList.contains('btn-decrease')) {
            const row = target.closest('tr');
            let currentQty = Number(row.querySelector('.qty-number').textContent);

            if(target.classList.contains('btn-increase')) {
                currentQty++;
                updateQuantity(row, currentQty);

                // Bisa tambahkan ajax/post ke backend untuk update session/cart jika perlu
            }
            else if(target.classList.contains('btn-decrease')) {
                if(currentQty > 1) {
                    currentQty--;
                    updateQuantity(row, currentQty);

                    // Bisa tambahkan ajax/post ke backend untuk update session/cart jika perlu
                }
            }
        }
    });
</script>
@endsection

