@extends('user.base.base')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/payment.css') }}">
@endpush

@section('content')
<div class="status-card">
    <h2 class="status-title">Payment Status</h2>

    <div>
        <div class="status-label">Invoice Number:</div>
        <div class="status-value">T20250518003</div>
    </div>

    <div>
        <div class="status-label">Total Amount:</div>
        <div class="status-value">Rp200.000</div>
    </div>

    <div>
        <div class="status-label">Payment Status:</div>
        <div class="status-paid">Paid</div>
    </div>

    <div class="status-note">Payment status checked manually.</div>

    <a href="{{ route('orders.show') }}" class="btn-view-orders">View My Orders</a>
</div>
@endsection