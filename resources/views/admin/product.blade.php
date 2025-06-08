@extends('admin.base.base')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amethyshelf Acdmin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Book List</h2>
    </div>

    <div class="search-add">
      <div>
      
      <form action="{{ route('product') }}" method="GET" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by ID, title or author then hit 'Enter'">
        <select name="category" onchange="this.form.submit()" class="category-filter">
          <option value="">All Categories</option>
          @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->categories_name }}
              </option>
          @endforeach
      </select>
      </div>

      <a href="{{ route('add-product') }}" class="add-btn">
      <i class="fa-solid fa-plus"></i> Add New Book
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
            <a href="{{ route('edit-product', ['id' => $product->id]) }}">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete Product?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete" style="background: none; border: none; padding: 0; color: #dc3545; cursor: pointer;">
                  <i class="fa-solid fa-trash"></i> Delete
              </button>
          </form>
        </td>
    </tr>
    @endforeach
    </tbody>
      </table>
    </div> 
      <div class="pagination-wrapper">
          {{ $products->appends(request()->query())->links() }}
      </div> 
</div>
@endsection