@extends('admin.base.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Amethyshelf Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Hello Admin !</h2>
        <p>Here's what's happening today!</p>
    </div>

    <!-- Cards -->
    <div class="stats-cards">
        <div class="card">
            <h3>Total Sales</h3>
            <p class="card-value">Rp. 1000.000.000</p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p class="card-value">1000000</p>
        </div>
        <div class="card">
            <h3>Total Active Orders</h3>
            <p class="card-value">100</p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p class="card-value">1000</p>
        </div>
    </div>

    <div class="h3-recent">
        <h5>Recent Order</h5>
    </div>

    <!-- Table -->
    <div class="recent-orders">
        <div class="table-wrapper"> 
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Books</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
                <tr>
                    <td>10/5/25</td>
                    <td>T20250401001</td>
                    <td>Budi Setiawan</td>
                    <td>4</td>
                    <td>Rp. 400.000</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
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

/* Table */
.recent-orders {
    background-color: #fff;
    border: 2px solid #d7c3f0;
    border-radius: 12px;
    padding: 10px;
    padding-top: 12px;
    margin-left: 20px;
}

.h3-recent h5 {
    margin-bottom: 10px;
    margin-left: 27px;
    font-size: 20px;
    font-weight: 650;
}

table {
    width: 100%;
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
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.table-wrapper table {
    width: 100%;
    min-width: 600px; /* or wider if needed */
    border-collapse: collapse;
}

th,
td {
    white-space: nowrap; /* Prevents text wrapping */
}

/* Optional: Scrollbar styling */
.table-wrapper::-webkit-scrollbar {
    height: 8px;
}
.table-wrapper::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}

/* Status colors */
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

@media (max-width: 768px) {
    /* Already present, keep this */
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
        justify-content: center; /* optional, for better mobile layout */
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