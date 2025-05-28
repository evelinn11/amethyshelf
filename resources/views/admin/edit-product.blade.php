@extends('admin.base.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Amethyshelf Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="dashboard-container">
    <div class="addnew"> 
    <h2>Edit Book</h2>
    </div>
    <div class="add-book-form">

    <!-- Photo Upload -->
      <div class="section">
        <label class="section-title">Edit Photo</label>
        <p class="note">Upload maximum 5 photos</p>
        <div class="photo-upload">
        @foreach ($book['images'] as $image)
            <div class="photo-slot">
            <div class="photo-box">
                <img src="{{ asset('images/' . $image) }}" alt="Book Photo" style="max-width: 100px;">            </div>
            <p>{{ $image }}</p>
            <a href="#">Remove photo</a>
            </div>
        @endforeach
        </div>
      </div>

      <!-- Form Fields -->
      <div class="form-split">
        <!-- Left Column -->
        <div class="column">
          <div class="form-group">
            <label>Book Title</label>
            <input type="text" name="title" value="{{ $book['title'] }}" placeholder="Maximum 100 characters" />          </div>
          <div class="row">
            <div class="form-group">
              <label>Published Year</label>
              <select name="year">
            <option value="">Select</option>
            @for ($y = 2000; $y <= now()->year; $y++)
                <option value="{{ $y }}" {{ $book['year'] == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
            </select>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="category">
                <option value="">Select</option>
                <option value="Fiksi" {{ $book['category'] == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                <option value="Non-Fiksi" {{ $book['category'] == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5">{{ $book['description'] }}</textarea>
          </div>
        </div>

        <!-- Right Column -->
        <div class="column">
          <div class="form-group">
            <label>Author Name</label>
            <input type="text" name="author" value="{{ $book['author'] }}" placeholder="Maximum 50 characters" />
          </div>
          <div class="form-group">
            <label>Publisher Name</label>
            <input type="text" name="publisher" value="{{ $book['publisher'] }}" placeholder="Maximum 50 characters" />
          </div>
          <div class="row">
            <div class="form-group">
              <label>Price</label>
              <input type="number" name="price" value="{{ $book['price'] }}" placeholder="Enter numbers only" />
            </div>
            <div class="form-group">
              <label>Stock</label>
              <input type="number" name="stock" value="{{ $book['stock'] }}" placeholder="Enter numbers only" />
            </div>
          </div>
          <div class="form-group">
            <label>Is this book?</label>
            <div class="radio-group">
            <label><input type="radio" name="type" value="Fiction" {{ $book['type'] == 'Fiction' ? 'checked' : '' }} /> Fiction</label>
            <label><input type="radio" name="type" value="Non-fiction" {{ $book['type'] == 'Non-fiction' ? 'checked' : '' }} /> Non-fiction</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="form-actions">
        <a href="{{ route('product') }}" class="btn cancel">Cancel</a>        
        <button type="button" class="btn finish" onclick="showPopup('popup1')">Finish</button>
      </div>

      <!-- Popup -->
      <div class="popup-overlay" id="popup1" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div class="popup-content" style="background:white; padding:20px; border-radius:8px; text-align:center; min-width:300px;">
          <h2>Success!</h2>
          <p>Edited Book: {{ $book['title'] }} </p>
          <div class="form-buttons" style="margin-top:20px;">
            <a href="{{ route('product') }}" class="btn close">Close</a>
          </div>
        </div>
      </div>

<script>
  function showPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
  }
  function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
  }
</script>
    </div>
</div>
@endsection

