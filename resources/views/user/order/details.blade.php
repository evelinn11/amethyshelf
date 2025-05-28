@extends('user.base.base')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #3C1361;">Order Details</h2>
        <p style="color: #3C1361;">Here are the details for your selected order</p>
    </div>
    
    <table class="table table-bordered">
        <tr>
            <th>Transaction ID</th>
            <td>{{ $orders->transactions_id }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td class="text-capitalize">
                @if ($orders->transactions_payment_method)
                    {{ $orders->transactions_payment_method }}
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>Rp {{ number_format($orders->transactions_total_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucwords($orders->transactions_order_status) }}</td>
        </tr>
        <tr>
            <th>Payment URL</th>
            <td>
                @if ($orders->payment_url && $orders->transactions_order_status == 'pending')
                    <a href="{{ $orders->payment_url }}" target="_blank" class="btn btn-sm btn-primary">Pay Now</a>
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td>{{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y H:i') }}</td>
        </tr>
    </table>

    @php
        // Group items by transactions_id
        $grouped = $order->groupBy('transactions_id');
    @endphp

    @foreach ($grouped as $transactionId => $items)
        <div class="mb-4">
            <h4 class="fw-semibold" style="color: #3C1361;">Ordered Items</h4>

            {{-- Stack cards vertically --}}
            <div class="d-flex flex-column gap-3 mt-2">
                @foreach ($items as $item)
                    <div class="card h-100 shadow-sm border-1">
                        <div class="d-flex align-items-start">
                            <!-- Image Container -->
                            <div style="width: 150px; overflow: hidden; flex-shrink: 0;">
                                <img src="{{ $item->products_image }}" alt="" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Text Content -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->products_name }}</h5>
                                <p class="card-text mb-1">Quantity: {{ $item->transaction_details_qty }}</p>
                                <p class="card-text mb-1">Unit Price: Rp {{ number_format($item->transaction_details_unit_price, 0, ',', '.') }}</p>
                                <p class="card-text mb-1">Subtotal: Rp {{ number_format($item->transaction_details_subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="mt-4">
        <a href="{{ route('orders.show') }}" class="btn btn-outline-secondary">← Back to Order History</a>
    </div>
</div>
@endsection
