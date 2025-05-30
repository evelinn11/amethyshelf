@extends('admin.base.base')

@section('content')
<div class="dashboard-container">
    <div class="addnew"> 
        <h2>Edit Book</h2>
    </div>
    <div class="add-book-form">

        @if (session('error'))
        <script>
            window.onload = function () {
                document.getElementById('popupMessage').textContent = '{{ session('error') }}';
                document.getElementById('popup1').style.display = 'flex';
            };
        </script>
        @endif

        @if (session('success'))
        <script>
            window.onload = function () {
                document.getElementById('popupMessage').textContent = '{{ session('success') }}';
                document.getElementById('popup1').style.display = 'flex';
            };
        </script>
        @endif

        <form action="{{ route('edit-product-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <!-- Photos to delete are appended dynamically -->
            
            <div class="section">
                <label class="section-title">Photos</label>
                <p class="note">Cannot edit photos</p>
                <div class="photo-upload" id="photoArea">
                    @php
                        $existingPhotos = $product->images ?? [];
                    @endphp

                    @foreach ($existingPhotos as $photo)
                        <div style="margin-right: 10px; position: relative;" class="existing-photo-preview" data-photo-id="{{ $photo->id }}">
                            <img src="{{ asset($photo->product_images_url) }}" style="width: 100px; height: 140px; object-fit: cover; border-radius: 8px;" />
                        </div>
                    @endforeach
                </div>
                @if ($errors->has('product_images.*'))
                    <p class="error-message">{{ $errors->first('product_images.*') }}</p>
                @endif
            </div>

            <div class="form-split">
                <!-- Left Column -->
                <div class="column">
                    <div class="form-group">
                        <label>Book Title</label>
                        <input 
                            type="text" 
                            name="products_title" 
                            id="bookTitle" 
                            placeholder="Maximum 100 characters" 
                            value="{{ old('products_title', $product->products_title ?? '') }}" 
                            class="{{ $errors->has('products_title') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_title'))
                            <p class="error-message">{{ $errors->first('products_title') }}</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Published Year</label>
                            <select name="products_published_year" required>
                                <option value="">Select Year</option>
                                @for ($year = 2025; $year >= 2000; $year--)
                                    <option value="{{ $year }}" {{ old('products_published_year', $product->products_published_year ?? '') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="section-title">Category</label>
                        <div class="checkbox-group">
                            @foreach ($categories as $category)
                                <div class="checkbox-item">
                                    <input 
                                        type="checkbox" 
                                        id="category-{{ $category->id }}" 
                                        name="categories[]" 
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                    >
                                    <label for="category-{{ $category->id }}">{{ $category->categories_name }}</label>
                                </div>
                            @endforeach   
                            @if ($errors->has('categories'))
                                <p class="error-message">{{ $errors->first('categories') }}</p>
                            @endif 
                        </div>         
                    </div>

                    <div class="form-group">
                        <label>Summary</label>
                        <textarea 
                            rows="5" 
                            name="products_summary" 
                            class="{{ $errors->has('products_summary') ? 'input-error' : '' }}"
                        >{{ old('products_summary', $product->products_summary ?? '') }}</textarea>
                        @if ($errors->has('products_summary'))
                            <p class="error-message">{{ $errors->first('products_summary') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div class="column">
                    <div class="form-group">
                        <label>Author Name</label>
                        <input 
                            type="text" 
                            name="products_author_name" 
                            placeholder="Maximum 50 characters" 
                            value="{{ old('products_author_name', $product->products_author_name ?? '') }}" 
                            class="{{ $errors->has('products_author_name') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_author_name'))
                            <p class="error-message">{{ $errors->first('products_author_name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Publisher Name</label>
                        <input 
                            type="text" 
                            name="products_publisher_name" 
                            placeholder="Maximum 50 characters" 
                            value="{{ old('products_publisher_name', $product->products_publisher_name ?? '') }}" 
                            class="{{ $errors->has('products_publisher_name') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_publisher_name'))
                            <p class="error-message">{{ $errors->first('products_publisher_name') }}</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Price</label>
                            <input 
                                type="number" 
                                name="products_price" 
                                placeholder="Enter numbers only" 
                                value="{{ old('products_price', $product->products_price ?? '') }}" 
                                class="{{ $errors->has('products_price') ? 'input-error' : '' }}"
                            />
                            @if ($errors->has('products_price'))
                                <p class="error-message">{{ $errors->first('products_price') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input 
                                type="number" 
                                name="products_stock" 
                                placeholder="Enter numbers only" 
                                value="{{ old('products_stock', $product->products_stock ?? '') }}" 
                                class="{{ $errors->has('products_stock') ? 'input-error' : '' }}"
                            />
                            @if ($errors->has('products_stock'))
                                <p class="error-message">{{ $errors->first('products_stock') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Pages</label>
                        <input 
                            type="text" 
                            name="products_total_pages" 
                            value="{{ old('products_total_pages', $product->products_total_pages ?? '') }}" 
                            class="{{ $errors->has('products_total_pages') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_total_pages'))
                            <p class="error-message">{{ $errors->first('products_total_pages') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Language</label>
                        <input 
                            type="text" 
                            name="products_languange" 
                            value="{{ old('products_languange', $product->products_languange ?? '') }}" 
                            class="{{ $errors->has('products_languange') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_languange'))
                            <p class="error-message">{{ $errors->first('products_languange') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>ISBN</label>
                        <input 
                            type="text" 
                            name="products_isbn" 
                            value="{{ old('products_isbn', $product->products_isbn ?? '') }}" 
                            class="{{ $errors->has('products_isbn') ? 'input-error' : '' }}"
                        />
                        @if ($errors->has('products_isbn'))
                            <p class="error-message">{{ $errors->first('products_isbn') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('product') }}" class="btn cancel">Cancel</a>        
                <button type="submit" class="btn finish">Finish</button>
            </div>

            @if (session('success'))
            <!-- Popup -->
            <div class="popup-overlay" id="popup1" style="display:flex; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
                <div class="popup-content" style="background:white; padding:20px; border-radius:8px; text-align:center; min-width:300px;">
                    <h2>Success!</h2>
                    <p id="popupMessage">{{ session('success') }}</p>
                    <div class="form-buttons" style="margin-top:20px;">
                        <a href="{{ route('product') }}" class="btn close">Close</a>
                    </div>
                </div>
            </div>
            @endif
        </form>
    </div>
</div>

<script>
    document.getElementById('photoArea').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-photo-link')) {
            e.preventDefault();
            const previewDiv = e.target.parentElement;
            const form = document.querySelector('form');
            const photoId = previewDiv.dataset.photoId;

            if (photoId) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'existing_photos_to_delete[]';
                input.value = photoId;
                form.appendChild(input);
            }

            previewDiv.remove();
            photoCount--;

            if (photoCount < maxPhotos && !document.querySelector('.photo-slot')) {
                addNewPhotoSlot();
            }
        }
    });
</script>

@endsection
