@extends('user.base.base')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/payment.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <h2>Status Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4 mt-3">
        <p><strong>Invoice Number:</strong> {{ $order->invoice_number ?? 'N/A' }}</p>
        <p><strong>Status:</strong> 
            @if(isset($order->status))
                @switch($order->status)
                    @case('paid')
                        <span class="text-success">Lunas</span>
                        @break
                    @case('pending')
                        <span class="text-warning">Menunggu Pembayaran</span>
                        @break
                    @case('expired')
                        <span class="text-danger">Kadaluarsa</span>
                        @break
                    @case('cancelled')
                        <span class="text-danger">Dibatalkan</span>
                        @break
                    @default
                        <span>{{ $order->status }}</span>
                @endswitch
            @else
                Tidak ada status pembayaran.
            @endif
        </p>

        @if(isset($status_message))
            <div class="alert alert-info">{{ $status_message }}</div>
        @endif

        <a href="{{ route('cart.index') }}" class="btn btn-primary mt-3">Kembali ke Keranjang</a>
    </div>
</div>

<style>
    .text-success { color: green; font-weight: 600; }
    .text-warning { color: orange; font-weight: 600; }
    .text-danger { color: red; font-weight: 600; }
</style>
@endsection