@extends('admin.base.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Amethyshelf Acdmin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Book List</h2>
    </div>

    <div class="search-add">
      <div style="display: flex; align-items: center; gap: 10px;">
      <form action="{{ route('product') }}" method="GET" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by ID, title or author then hit 'Enter'">
      </form>

      <form action="{{ route('product') }}" method="GET">
        <button type="submit" class="clear">Clear</button>
      </form>
      </div>

      <a href="{{ route('add-product') }}">
        <button class="add-btn">
          <i class="fa-solid fa-plus"></i> Add New Book
        </button>
      </a>
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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td><div class="truncate-text" title="{{ $product->products_title }}">{{ $product->products_title }}</div></td>
        <td><div class="truncate-text" title="{{ $product->products_author_name }}">{{ $product->products_author_name }}</div></td>
        <td>Rp {{ number_format($product->products_price, 0, ',', '.') }}</td>
        <td>{{ $product->products_stock }}</td>
        <td>
            <a href="{{ route('edit-product') }}" class="edit">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
            <a href="{{ route('product', ['delete_id' => $product['id']]) }}" onclick="return confirm('Yakin ingin menghapus?')" class="delete">
                <i class="fa-solid fa-trash"></i> Delete
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
      </table>
    </div>  
</div>
@endsection