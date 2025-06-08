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
            color: #28a745;
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .status-pending {
            color: #ffc107;
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .status-cancelled {
            color: #dc3545;
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .status-expired {
            color: #6c757d;
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .status-unknown {
            color: #343a40;
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
            margin-top: 1rem;
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

        .button-red {
            margin-top: 1rem;
            background-color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.4rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .button-red:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
            color: white;
        }

        /* === Responsive Adjustment === */
        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }

            .status-card {
                margin: 2rem auto;
                padding: 2rem 1.2rem;
            }

            .button-purple,
            .button-red {
                width: 100%;
                padding: 0.75rem;
                font-size: 1rem;
            }

            .status-title {
                font-size: 1.5rem;
            }

            .status-value {
                font-size: 1.1rem;
            }

            .status-label {
                font-size: 0.95rem;
            }

            .status-note {
                font-size: 0.85rem;
            }
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
            @php
                $statusClass = match ($transactions->order_status) {
                    'completed', 'paid' => 'status-paid',
                    'pending' => 'status-pending',
                    'cancelled' => 'status-cancelled',
                    'expired' => 'status-expired',
                    default => 'status-unknown',
                };
            @endphp

            <div class="{{ $statusClass }}">{{ ucfirst($transactions->order_status) }}</div>

        </div>

        <div class="status-note">{{ $status_message }}</div>

        <a href="{{ route('payment.status', $transactions->id) }}" class="button-purple">Check Status Again</a>
        <a href="{{ route('orders.show') }}" class="button-purple">View My Orders</a>
        @if ($transactions->order_status === 'pending' && $transactions->payment_method !== 'Akulaku' && $transactions->payment_method !== 'Convenience Store')
            <form action="{{ route('transactions.cancel', $transactions->id) }}" method="POST"
                style="display:block;" onsubmit="return confirm('Are you sure to cancel this transaction?');">
                @csrf
                <button class="button-red" type="submit">Cancel Order</button>
            </form>
        @endif

    </div>
@endsection
