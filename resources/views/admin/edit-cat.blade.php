@extends('admin.base.base')
@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing styles here */
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

        /* button save */
        .save {
            background: #b38cf8;
            color: white;
        }

        /* button cancel */
        .cancel {
            background: #999;
            color: white;
        }

        .form-buttons .cancel a {
            color: rgb(255, 255, 255);
            text-decoration: none;
            display: block;
            width: 100%;
            height: 100%;
        }

        .form-buttons .cancel:hover a {
            color: rgb(0, 0, 0);
            text-decoration: none;
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
    </style>
</head>

<div class="category-container">
    <div class="category-header">
        <h2>Edit Category</h2>
    </div>

    @php
        // Loop to find the description for the current category ID in $categories
        $desc = '';
        foreach ($categories as $cat) {
            if ($cat->id == $category->id) {
                $desc = $cat->description;
                break;
            }
        }
    @endphp

    <div class="add-cat-form">
        <form action="{{ route('edit-category-post', $category->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" placeholder="Maximum 35 characters" maxlength="35" required
                    value="{{ old('name', $category->categories_name) }}" />
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6" placeholder="Enter the Category's Description" required>{{ old('description', $category->categories_description) }}</textarea>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn cancel">
                    <a href="{{ route('category') }}">Cancel</a>
                </button>
                <button type="submit" class="btn save">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
