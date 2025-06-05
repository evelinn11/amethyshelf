@extends('user.base.base')

@push('styles')
    <style>
        body {
            background-color: #f8f3ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .status-card {
            max-width: 480px;
            margin: 5rem auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(97, 67, 157, 0.15);
            padding: 2.5rem 3rem;
            text-align: center;
        }

        .status-title {
            color: #3C1361;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .status-label {
            font-weight: 600;
            color: #555;
            margin-top: 1.2rem;
        }

        .status-value {
            font-weight: 700;
            font-size: 1.3rem;
            color: #3C1361;
            margin-bottom: 0.7rem;
        }

        .status-paid {
            color: #28a745; /* Hijau untuk Paid/Completed */
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .status-note {
            font-size: 0.9rem;
            color: #777;
            margin-top: 0.3rem;
            font-style: italic;
        }

        .button-purple {
            margin-top: 1.5rem;
            background-color: #3C1361;
            border: 1px solid #3C1361;
            padding: 0.6rem 2.2rem;
            font-weight: 600;
            color: white;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .button-purple:hover {
            background-color: #5936a2;
            border-color: #5936a2;
            color: white;
        }

        .text-purple {
            color: #3C1361;
        }
    </style>
@endpush

@section('content')
    <div class="status-card">
        <h2 class="status-title">Payment Status</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div>
            <div class="status-label">Invoice Number:</div>
            <div class="status-value">{{ $transactions->invoice_number }}</div>
        </div>

        <div>
            <div class="status-label">Total Amount:</div>
            <div class="status-value">Rp{{ number_format($transactions->total_amount) }}</div>
        </div>

        <div>
            <div class="status-label">Payment Status:</div>
            <div class="status-paid">{{ ucfirst($transactions->order_status) }}</div>
        </div>

        <div class="status-note">{{ $status_message }}</div>

        <a href="{{ route('payment.status', $transactions->id) }}" class="button-purple">Check Status Again</a>
        <a href="{{ route('orders.show') }}" class="button-purple">View My Orders</a>
    </div>
@endsection
