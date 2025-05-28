@extends('admin.base.base')
<head>
    <meta charset="UTF-8" />
    <title>Amethyshelf Admin - Category Books</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Books in “{{ $categoryName }}”</h2>
    </div>

    <div class="search-add">
        <div class="search-bar">
            <input type="text" placeholder="Search by ID or title or author" />
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="form-buttons">
            <button class="add-btn back">
                <a href="{{ route('category') }}">Back</a>
            </button>
        </div>
    </div>

    <div class="table-container-product">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
             <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['author'] }}</td>
                    <td>Rp. {{ number_format($book['price'], 0, ',', '.') }}</td>
                    <td>{{ $book['stock'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .dashboard-container {
        padding: 20px;
        background-color: #f9f9f9;
        min-height: 100vh;
    }

    .dashboard-header h2 {
        margin-bottom: 15px;
        font-weight: 800;
        font-size: 24px;
        color: #333;
    }

    .search-add {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .search-bar {
        position: relative;
        width: 550px;
    }

    .search-bar input {
        width: 100%;
        padding: 6px 50px 6px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .search-bar i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
    }

    .add-btn {
        background-color: #b18dfc;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .add-btn.back {
        background-color: #999;
    }

    .add-btn.back a {
        color: white;
        text-decoration: none;
    }

    .add-btn.back:hover a {
        color: black;
    }

    .table-container-product {
        border: 2px solid #c7b3ff;
        border-radius: 10px;
        overflow-x: auto;
        background-color: #fff;
        padding: 10px;
    }

    .table-container-product table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
    }

    .table-container-product thead {
        background-color: #e6dffe;
    }

    .table-container-product th,
    .table-container-product td {
        padding: 8px 19px;
        text-align: left;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        color: #333;
    }

    @media (max-width: 768px) {
        .add-btn {
            width: 90%;
            text-align: center;
            font-size: 12px;
            margin-left: 10px;
        }

        .search-bar {
            flex: 1;
        }

        .dashboard-container {
            margin-top: 130px;
        }
    }

    @media (max-width: 480px) {
        .add-btn {
            padding: 6px 10px;
            font-size: 13px;
        }
    }
</style>
@endsection