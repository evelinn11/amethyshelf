@extends('admin.base.base')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            background-color: #f4f4f4;
            font-family: "Inter";
        }

        .category-container {
            margin-left: 235px;
            padding: 20px;
            background-color: #f4f4f4;
            overflow-x: hidden;
            box-sizing: border-box;
            max-width: calc(100vw - 250px);
        }

        .category-header h2 {
            font-size: 25px;
            margin-left: 22px;
            margin-top: 10px;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .custom-container {
            border: 2px solid #c7b3ff;
            border-radius: 10px;
            padding: 15px;
            margin-left: 20px;
        }

        .action-link {
            color: #8e44ad;
            text-decoration: none;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .icon-eye {
            margin-right: 5px;
        }

        .search-add {
            margin-left: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .search-bar {
            position: relative;
            width: 550px;
            margin-left: 0px;
            margin-bottom: 10px;
        }

        .search-bar input {
            width: 100%;
            padding: 4px 50px 4px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .search-bar i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .add-btn {
            background-color: #b18dfc;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            margin-right: 10px;
        }

        .add-btn:hover {
            background-color: #996bfa;
        }

        .add-btn i {
            margin-right: 5px;
        }

        .edit i {
            margin-left: 10px;
        }

        .edit {
            margin-right: 10px;
        }

        table.table thead {
            background-color: #c7b3ff !important;
        }

        .summary-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            margin-left: 20px;
        }

        .summary-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1 1 200px;
            min-width: 200px;
        }

        .summary-box p {
            margin: 5px 0;
        }

        .summary-label {
            font-size: 16px;
            color: #555;
        }

        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        .table-container-product {
            border: 2px solid #c7b3ff;
            border-radius: 10px;
            overflow-x: auto;
            margin-left: 20px;
            padding: 10px;
            background-color: #fff;
        }

        @media (max-width: 768px) {
            .category-container {
                margin-left: 0;
                max-width: 100vw;
                padding: 15px;
                margin-top: 80px;
            }
        }

        @media (max-width: 768px) {
            .table-container-product {
                margin-left: 0;
            }

            table {
                min-width: 600px;
                /* or whatever your min width needs */
            }
        }
    </style>

    @section('content')
        <div class="category-container">
            <div class="category-header">
                <h2>All Orders</h2>
            </div>
            <div class="summary-container">
                <div class="summary-box">
                    <p class="summary-label">Total Orders</p>
                    <p class="summary-value">{{ $totalOrders }}</p>
                </div>
                <div class="summary-box">
                    <p class="summary-label">Pending Orders</p>
                    <p class="summary-value">{{ $pending }}</p>
                </div>
                <div class="summary-box">
                    <p class="summary-label">Cancelled Orders</p>
                    <p class="summary-value">{{ $cancelled }}</p>
                </div>
                <div class="summary-box">
                    <p class="summary-label">Completed</p>
                    <p class="summary-value">{{ $completed }}</p>
                </div>
            </div>
            <div class="table-container-product">
                <table class="min-w-full bg-white rounded shadow">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Order ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Total Amount</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $order->created_at }}</td>
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->user->name }}</td>
                                <td class="px-4 py-2">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <span
                                        class="font-semibold
                                            @if ($order->order_status == 'pending') text-yellow-500
                                            @elseif($order->order_status == 'completed') text-green-500
                                            @elseif($order->order_status == 'cancelled') text-red-500
                                            @elseif($order->order_status == 'expired') text-gray-500 @endif">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-indigo-600 hover:underline">
                                    <a href="{{ route('admin-order-details', $order->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    @endsection
