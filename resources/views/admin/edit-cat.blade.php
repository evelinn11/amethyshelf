@extends('admin.base.base')
@section('content')
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">
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
    margin-left: 235px; /* match your .sidebar width exactly */
    padding: 20px;
    /* background-color: #f4f4f4; */
    overflow-x: hidden;
    box-sizing: border-box;
    max-width: calc(100vw - 250px);
    }
    .category-header h2 {
    font-size: 25px;
    margin-left: 23px;
    margin-top: 10px;
    font-weight: 800;
    margin-bottom: 20px;
    }
    .add-cat-form {
    min-width: 200px;
    padding: 15px;
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    text-align: left;
    margin-left: 20px;
    }
    .form-group {
    margin-bottom: 20px;
    }
    .form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    margin-left: 40px;
    margin-top: 15px;
    font-size: 20px;
    }
    input,
    select,
    textarea {
    width: 90%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 15px;
    padding-left: 8px;
    margin-left: 40px;
    }
    .form-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 30px;
    /* text-align: center; */
    }
    .form-buttons .btn {
    width: 120px;
    }
    .btn {
    padding: 10px 24px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    text-align: center;
    }
    /* utk btton save */
    .save {
    background: #b38cf8;
    color: white;
    }
    /* utk btton cancel */
    .cancel {
    background: #999;
    color: white;
    }
    /* utk btton close di popup */
    .close {
    background: #999;
    color: white;
    }
    .form-buttons .cancel a, .save a, .close a {
    color: rgb(255, 255, 255);
    text-decoration: none;
    }
    .form-buttons .cancel:hover a, .save:hover a, .close:hover a {
    color: rgb(0, 0, 0);
    text-decoration: none;
    }
    /* Popup Styling */
    .popup-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 999;
    }
    .popup-content {
    background: white;
    padding: 24px;
    border-radius: 12px;
    max-width: 400px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    text-align: center;
    }
    .popup-content h2 {
    margin-top: 0;
    }

    @media (max-width: 768px) {
    .category-container {
        margin-left: 15px;
        margin-right: 10px;
        max-width: 100vw;
        padding: 10px;
        margin-top: 135px;
    }

    .add-cat-form {
        margin-left: 0;
    }

    .form-group label,
    input,
    select,
    textarea {
        margin-left: 0;
        width: 100%;
    }
}

    /* .close-btn {
    margin-top: 16px;
    padding: 8px 16px;
    background: #a78bfa;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    }
    .close-btn:hover {
    background: #844ae8;
    text-decoration: none;
    } */
</style>
</head>
<div class="category-container">
<div class="category-header">
<h2>Edit New Category</h2>
</div>
<div class="add-cat-form">
<div class="form-group">
<label>Name</label>
<input type="text" placeholder="Maximum 35 characters" value="{{ old('name', $category['name']) }}" /></div>
<div class="form-group">
<label>Description</label>
<textarea rows="6" placeholder="Enter the Category's Description">{{ old('description', $category['description']) }}</textarea></div>
<!-- Buttons -->
{{-- <div class="form-buttons">
<button class="btn btn-secondary">Cancel</button>
<button class="btn save">Save</button>
</div> --}}
<div class="form-buttons">
<button class="btn cancel">
<a href="{{ route('category') }}">Cancel</a>
</button>
<button class="btn save" onclick="showPopup('popup1')">
<a href="#">Save</a>
</button>
</div>
</div>
</div>
<!-- Popup -->
<div class="popup-overlay" id="popup1">
<div class="popup-content">
<h2>Edited {{ old('name', $category['name']) }}</h2>
<p>Detail Category:</p>
<p>{{ old('description', $category['description']) }}</p>
<div class="form-buttons">
<button class="btn close">
<a href="{{ route('category') }}">Close</a>
</button>
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
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.10.5/font/bootstrap-icons.css">
@endsection