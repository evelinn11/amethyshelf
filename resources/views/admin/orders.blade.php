@extends('admin.base.base')

<head>
    <meta charset="UTF-8">
    <title>All Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>All Orders</h2>
            <p>Here is a summary and list of all orders</p>
        </div>

        <!-- Summary Cards -->
        <div class="stats-cards">
            <div class="card">
                <h3>Total Orders</h3>
                <p class="card-value">{{ $totalOrders }}</p>
            </div>
            <div class="card">
                <h3>Pending Orders</h3>
                <p class="card-value">{{ $pending }}</p>
            </div>
            <div class="card">
                <h3>Cancelled Orders</h3>
                <p class="card-value">{{ $cancelled }}</p>
            </div>
            <div class="card">
                <h3>Completed</h3>
                <p class="card-value">{{ $completed }}</p>
            </div>
        </div>

        <!-- Order Table -->
        <div class="h3-recent">
            <h5>Order List</h5>
        </div>
        <div class="recent-orders">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d/m/y') }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusClass = match(strtolower($order->order_status)) {
                                            'pending' => 'pending',
                                            'completed' => 'completed',
                                            'cancelled' => 'cancelled',
                                            'expired' => 'expired',
                                            default => '',
                                        };
                                    @endphp
                                    <span class="status {{ $statusClass }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td class="text-indigo-600 hover:underline">
                                    <a href="{{ route('admin-order-details', $order->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<style>
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    .dashboard-container {
        margin-left: 235px;
        padding: 20px;
        background-color: #f4f4f4;
        overflow-x: hidden;
        box-sizing: border-box;
        max-width: calc(100vw - 250px);
    }

    .dashboard-header h2 {
        font-size: 25px;
        margin-left: 25px;
        margin-top: 10px;
        font-weight: 800;
    }

    .dashboard-header p {
        color: #888;
        margin-bottom: 15px;
        margin-left: 25px;
        font-weight: 600;
    }

    /* Cards */
    .stats-cards {
        margin-left: 20px;
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .card {
        min-width: 200px;
        padding: 20px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    .card h3 {
        font-size: 20px;
        font-weight: 600;
        color: #a96be0;
        margin-bottom: 10px;
    }

    .card-value {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        margin: 0;
    }

    /* Table Section */
    .h3-recent h5 {
        margin-bottom: 10px;
        margin-left: 27px;
        font-size: 20px;
        font-weight: 650;
    }

    .recent-orders {
        background-color: #fff;
        border: 2px solid #d7c3f0;
        border-radius: 12px;
        padding: 10px;
        padding-top: 12px;
        margin-left: 20px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 600px;
        border-collapse: collapse;
    }

    thead {
        background-color: #e6dffe;
        border-bottom: 1px solid #c1acf8;
    }

    th,
    td {
        padding: 8px 10px;
        text-align: left;
        border-bottom: 1px solid #d9d9d9;
        font-size: 13px;
        white-space: nowrap;
    }

    /* Status Colors */
    .status {
        font-weight: bold;
        border-radius: 6px;
    }

    .status.pending {
        color: orange;
    }

    .status.completed {
        color: green;
    }

    .status.cancelled {
        color: red;
    }

    .status.expired {
        color: gray;
    }

    /* Scrollbar Styling */
    .table-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-container {
            margin-left: 0;
            padding-top: 70px;
            max-width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }

        .dashboard-header h2,
        .dashboard-header p,
        .stats-cards,
        .recent-orders,
        .h3-recent h5 {
            margin-left: 0;
        }

        .stats-cards {
            justify-content: center;
        }

        .card {
            width: 100%;
            max-width: 100%;
        }

        .recent-orders {
            margin-left: 0;
        }

        .h3-recent h5 {
            margin-left: 0;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin-top: 80px;
        }
    }
</style>
