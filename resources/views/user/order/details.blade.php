@extends('user.base.base')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #3C1361;">Order Details</h2>
            <p style="color: #3C1361;">Here are the details for your selected order</p>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Invoice Number</th>
                <td>{{ $order->invoice_number }}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td class="text-capitalize">
                    @if ($order->payment_method)
                        {{ $order->payment_method }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucwords($order->order_status) }}</td>
            </tr>
            <tr>
                <th>Payment URL</th>
                <td>
                    @if ($order->payment_url && $order->order_status == 'pending')
                        <a href="{{ $order->payment_url }}" target="_blank" class="btn btn-sm btn-primary">Pay Now</a>
                    @else
                        <a href="{{ $order->payment_url }}" target="_blank">{{ $order->payment_url }}</a>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <h4 class="fw-semibold" style="color: #3C1361;">Ordered Items</h4>

        <div class="d-flex flex-column gap-3 mt-2">
            @foreach ($order->details as $detail)
                <div class="card h-100 shadow-sm border-1">
                    <div class="d-flex align-items-start">
                        <!-- Image Container -->
                        <div style="width: 150px; overflow: hidden; flex-shrink: 0;">
                            <img src="{{ asset($detail->product->primaryImage->product_images_url ?? '' )}}" alt=""
                                class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Text Content -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $detail->product->products_title ?? 'Unknown Product' }}</h5>
                            <p class="card-text mb-1">Quantity: {{ $detail->quantity }}</p>
                            <p class="card-text mb-1">Unit Price: Rp
                                {{ number_format($detail->unit_price, 0, ',', '.') }}</p>
                            <p class="card-text mb-1">Subtotal: Rp
                                {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="mt-4">
            <a href="{{ route('orders.show') }}" class="btn btn-outline-secondary">← Back to Order History</a>
        </div>
    </div>
@endsection
