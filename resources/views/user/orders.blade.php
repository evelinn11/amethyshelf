@extends('user.base.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/orders.css') }}">
@endpush

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-purple">Order History</h2>
            <p class="text-purple">Track your book order status</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                You don't have any orders yet.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Payment Method</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Payment URL</th>
                            <th>Order Date</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_number }}</td>

                                <td class="text-capitalize">
                                    @if ($order->payment_method)
                                        {{ $order->payment_method }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $status = strtolower($order->order_status);
                                        $statusColors = [
                                            'completed' => 'success',
                                            'pending' => 'warning text-dark',
                                            'cancelled' => 'danger',
                                            'expired' => 'secondary',
                                        ];
                                        $color = $statusColors[$status] ?? 'info';
                                    @endphp
                                    <a href="{{ route('payment.status', $order->id) }}"
                                        class="badge bg-{{ $color }} badge-status text-decoration-none">
                                        {{ ucwords($order->order_status) }}
                                    </a>
                                </td>
                                <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    @if ($order->payment_url && $order->order_status == 'pending')
                                        <a href="{{ $order->payment_url }}" target="_blank" class="btn btn-sm btn-primary">
                                            Pay Now
                                        </a>
                                    @else
                                        <a href="{{ $order->payment_url }}" target="_blank" style="display: inline-block; max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; vertical-align: middle;">{{ $order->payment_url }}</a>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('order.details', ['id' => $order->id]) }}"
                                        class="btn btn-sm button-purple text-white">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
