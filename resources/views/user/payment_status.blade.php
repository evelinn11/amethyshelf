@extends('user.base.base')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/payment.css') }}">
@endpush

@section('content')
<div class="container">
    <h1>Payment Status</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <p><strong>Invoice Number:</strong> {{ $order->invoice_number }}</p>
    <p><strong>Total Amount:</strong> Rp {{ number_format($order->total_price) }}</p>
    <p><strong>Payment Status:</strong> {{ ucfirst($order->status) }}</p>
    <p>{{ $status_message }}</p>

    <a href="{{ route('payment.status', ['order' => $order->id]) }}">Check Status</a>
    <a href="{{ route('payment.status', $order->id) }}" class="btn btn-secondary">Check Status Again</a>
    <a href="{{ route('orders.show') }}" class="btn btn-primary">View My Orders</a>
</div>
@endsection