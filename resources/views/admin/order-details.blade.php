@extends('admin.base.base')

@section('content')
    <style>
        .order-details-container {
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

        .section-box {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-box h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .grid-2 {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .info-block {
            flex: 1;
            min-width: 300px;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-row strong {
            width: 130px;
            display: inline-block;
        }

        .highlight-box {
            background-color: #f4efff;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f7f7f7;
        }

        .status-box {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
        }

        .status-box .status {
            font-weight: bold;
            color: green;
        }

        .payment-details {
            border-left: 1px solid #ccc;
            padding-left: 20px;
        }

        .order-details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .transaction-id {
            color: #4a00c9;
            font-weight: bold;
            text-decoration: none;
        }

         @media (max-width: 768px) {
        .grid-2 {
            flex-direction: column;
        }

        .payment-details {
            border-left: none;
            padding-left: 0;
        }
    }

    .info-block {
        flex: 1;
        min-width: 300px;
    }

    .info-row {
        margin-bottom: 8px;
    }

    .info-row strong {
        width: 130px;
        display: inline-block;
    }

    .highlight-box {
        background-color: #f4efff;
        border-radius: 6px;
        padding: 15px;
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f7f7f7;
    }

    .status-box {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        background-color: #fff;
    }

    .status-box .status {
        font-weight: bold;
        color: green;
    }

    .payment-details {
        border-left: 1px solid #ccc;
        padding-left: 20px;
    }

    .order-details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .transaction-id {
        color: #4a00c9;
        font-weight: bold;
        text-decoration: none;
    }
    
     .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        display: block;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-wrapper table {
        width: 100%;
        min-width: 100%;
    }

    .table-responsive-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive-wrapper::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    /* Fix for mobile screens */
    @media (max-width: 768px) {
        .order-details-container {
            margin-left: 0;
            max-width: 100vw;
            padding: 10px;
            margin-top: 80px;
        }

        .table-responsive-wrapper {
            overflow-x: auto;
            display: block;
            -webkit-overflow-scrolling: touch; /* for iOS smooth scroll */
        }

        .table-responsive-wrapper table {
            min-width: 600px; /* Force horizontal scroll */
        }

        .section-box {
            width: 100%;
        }

        .status-box {
            width: 100%;
            margin-top: 20px;
        }
    }

    @media (max-width: 625px) {
    .table-responsive-wrapper {
        overflow-x: auto;
        display: block;
        -webkit-overflow-scrolling: touch; 
    }

    .table-responsive-wrapper table {
        min-width: 600px;
    }

    .table-responsive-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive-wrapper::-webkit-scrollbar-thumb {
        background: #bbb;
        border-radius: 3px;
    }
}

    </style>

    <div class="order-details-container">
        <div class="category-header">
            <h2>Order Details</h2>
        </div>

        <div class="grid-2 section-box">
            <div class="info-block">
                <div class="info-row"><strong>Transaction ID:</strong> <a class="transaction-id"
                        href="#">T20250401001</a></div>
                <div class="info-row"><strong>Name:</strong> Budi Setiawan</div>
                <div class="info-row"><strong>Email:</strong> budi@gmail.com</div>
                <div class="info-row"><strong>Phone Number:</strong> 0812345678</div>
                <div class="info-row"><strong>Created at:</strong> 10 Mar 2025 15:30</div>

                <div class="highlight-box">
                    <strong>Address</strong><br>
                    Citraland CBD Boulevard, Made, Kec. Sambikerep, Kota Surabaya, Jawa Timur, 60219, Indonesia.<br>
                    081231231321
                </div>
            </div>

            <div class="payment-details">
                <div class="info-row"><strong>Payment Method:</strong> QRIS</div>
                <div class="info-row"><strong>Payment URL:</strong> <a href="#">Link</a></div>
                <div class="info-row"><strong>Total Books:</strong> 4</div>
                <div class="info-row"><strong>Final Amount:</strong> <span style="color: #4a00c9">Rp. 400.000</span></div>
            </div>
        </div>

        <div class="grid-2">
            <div class="section-box" style="flex: 3">
                <h2>Order</h2>
                <div class="table-responsive-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Atomic Habits</td>
                                <td>2</td>
                                <td>Rp. 150.000</td>
                                <td>Rp. 300.000</td>
                            </tr>
                            <tr>
                                <td>Bumi Manusia</td>
                                <td>2</td>
                                <td>Rp. 50.000</td>
                                <td>Rp. 100.000</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                                <td><strong>Rp. 400.000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="status-box" style="flex: 1">
                <h3>Order Status:</h3>
                <p class="status">Completed</p>
                <div style="margin-top: 15px;">
                    <strong>Shipping Number:</strong><br>
                    TJNEXPRESS12324
                </div>
            </div>
        </div>
    </div>
@endsection
