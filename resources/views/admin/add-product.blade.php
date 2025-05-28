@extends('admin.base.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Amethyshelf Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="dashboard-container">
    <div class="addnew"> 
    <h2>Add New Book</h2>
    </div>
    <div class="add-book-form">

    <form action="{{ route("add-product-post") }}" method="POST" enctype="multipart/form-data">
    @csrf
      <!-- Photo Upload -->
        <div class="section">
              <label class="section-title">Add Photo</label>
              <p class="note">Upload up to 3 photo</p>
              <div class="photo-upload" id="photoArea">
                  <!-- Hidden file input -->
                  <input type="file" name="photos[]" accept="image/*" style="display: none;" class="photo-input" onchange="handlePhotoUpload(this)" />
              </div>
          </div>

        <!-- Form Fields -->
        <div class="form-split">
          <!-- Left Column -->
          <div class="column">
            <div class="form-group">
              <label>Book Title</label>
              <input type="text" id="bookTitle" name="book_title" placeholder="Maximum 100 characters" />
            </div>
            <div class="row">
              <div class="form-group">
                <label>Published Year</label>
                <select name="published_year" required>
                  <option value="">Select Year</option>
                  @for ($year = 2025; $year >= 2000; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                  @endfor
              </select>
              </div>
            </div>
            <div class="form-group">
                <label class="section-title">Category</label>
                <div class="checkbox-group">
                  @foreach ($categories as $category)
                    <div class="checkbox-item">
                      <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                      <label for="category-{{ $category->id }}">{{ $category->categories_name }}</label>
                    </div>
                  @endforeach    
                </div>         
              </div>
            <div class="form-group">
              <label>Summary</label>
              <textarea rows="5" name="summary"></textarea>
            </div>
          </div>

          <!-- Right Column -->
          <div class="column">
            <div class="form-group">
              <label>Author Name</label>
              <input type="text" name="author_name" placeholder="Maximum 50 characters" />
            </div>
            <div class="form-group">
              <label>Publisher Name</label>
              <input type="text" name="publisher_name" placeholder="Maximum 50 characters" />
            </div>
            <div class="row">
              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" placeholder="Enter numbers only" />
              </div>
              <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" placeholder="Enter numbers only" />
              </div>
            </div>
            <div class="form-group">
                <label>Total Pages</label>
                <input type="text" name="total_pages" />
            </div>
            <div class="form-group">
              <label>Language</label>
              <input type="text" name="language" />
            </div>
            <div class="form-group">
              <label>ISBN</label>
              <input type="text" name="isbn" />
            </div>
          </div>
        </div>
        
        <!-- Buttons TYPE HRS SUBMIT BUAT INSERT KE DB--> 
      <div class="form-actions">
        <a href="{{ route('product') }}" class="btn cancel">Cancel</a>        
        <button type="button" class="btn finish" onclick="showPopup('popup1')">Finish</button>
      </div>

      <!-- Popup -->
      <div class="popup-overlay" id="popup1" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div class="popup-content" style="background:white; padding:20px; border-radius:8px; text-align:center; min-width:300px;">
          <h2>Success!</h2>
          <p id="popupMessage">Buku berhasil diupload</p>
          <div class="form-buttons" style="margin-top:20px;">
            <a href="{{ route('product') }}" class="btn close">Close</a>
          </div>
        </div>
      </div>
    </form>

<script>
  function showPopup(popupId) {
    const title = document.getElementById('bookTitle').value.trim();
    const popupMessage = document.getElementById('popupMessage');

    if (title) {
      popupMessage.textContent = `"${title}" berhasil diupload`;
    } else {
      popupMessage.textContent = 'Buku berhasil diupload';
    }

    document.getElementById(popupId).style.display = 'flex';
  }

  //Photo
  let photoCount = 0;
  const maxPhotos = 3;

  function triggerPhotoInput(slot) {
      if (photoCount >= maxPhotos) return;

      const input = document.createElement('input');
      input.type = 'file';
      input.name = 'photos[]';
      input.accept = 'image/*';
      input.className = 'photo-input';
      input.style.display = 'none';
      input.onchange = function () {
          handlePhotoUpload(input);
      };

      document.body.appendChild(input);
      input.click();
  }

  function handlePhotoUpload(input) {
  const file = input.files[0];
  if (!file || photoCount >= maxPhotos) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const previewBox = document.createElement('div');
    previewBox.style.marginRight = '10px';
    previewBox.style.position = 'relative';

    previewBox.innerHTML = `
      <img src="${e.target.result}" style="width: 100px; height: 140px; object-fit: cover; border-radius: 8px;" />
      <a href="#" class="remove-photo-link" style="position: absolute; top: 5px; right: 5px;">Remove</a>
    `;

    previewBox.querySelector('.remove-photo-link').addEventListener('click', function(event) {
      event.preventDefault();
      previewBox.remove();
      input.remove();
      photoCount--;
      if (photoCount < maxPhotos && !document.querySelector('.photo-slot')) {
        addNewPhotoSlot();
      }
    });

    const photoArea = document.getElementById('photoArea');

    photoArea.appendChild(previewBox);  // add new photo preview

    // Move the photo slot to the end so it stays last
    const slot = document.querySelector('.photo-slot');
    if (slot) {
      photoArea.appendChild(slot);
    }
  };
  reader.readAsDataURL(file);

  document.getElementById('photoArea').appendChild(input);
  photoCount++;

  // Remove existing add photo slots (should only be 1)
  const slots = document.querySelectorAll('.photo-slot');
  slots.forEach(slot => slot.remove());

  if (photoCount < maxPhotos) {
    addNewPhotoSlot();
  }
}


  function addNewPhotoSlot() {
      const slot = document.createElement('div');
      slot.className = 'photo-slot';
      slot.onclick = function () {
          triggerPhotoInput(slot);
      };
      slot.innerHTML = `
          <div class="photo-box"><span>+</span></div>
          <p>Add Photo</p>
      `;
      document.getElementById('photoArea').appendChild(slot);
  }

  function removePhotos(event) {
      event.preventDefault();
      document.getElementById('photoArea').innerHTML = '';
      photoCount = 0;
      addNewPhotoSlot();
  }

  // Initialize with one photo slot
  window.onload = () => {
      addNewPhotoSlot();
  };

  //Category
  const select = document.querySelector('select[name="categories[]"]');

  select.addEventListener('change', () => {
    const selectedOptions = Array.from(select.selectedOptions).map(opt => opt.value);
    console.log(selectedOptions); // This is your updated array
  });
</script>
@endsection
        