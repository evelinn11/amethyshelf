@extends('admin.base.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Add User - Amethyshelf Admin</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f5f5;
            font-family: "Inter", sans-serif;
        }

        .user-container {
            margin-left: 235px;
            padding: 20px;
            max-width: 100vw; /* full width */
            box-sizing: border-box;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .user-header h2 {
            font-size: 25px;
            margin-left: 32px;
            margin-top: 10px;
            font-weight: 800;
            margin-bottom: 20px;
            color: #333;
        }

        .add-user-form {
            padding: 30px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative
        }

        .form-group label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        input, select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
            padding-left: 8px;
            width: 100%;
        }

        .input-error {
            border-color: red !important;
        }

        /* Form actions span two columns */
        .form-actions {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 24px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }

        .btn.cancel {
            background: #999;
        }

        .btn.cancel:hover {
            background: #777;
        }

        .btn.save {
            background: #b38cf8;
        }

        .btn.save:hover {
            background: #9a6de0;
        }

        @media (max-width: 768px) {
            .user-container {
                margin-left: 15px;
                margin-right: 10px;
                max-width: 100vw;
                padding: 10px;
                margin-top: 135px;
            }

            .add-user-form {
                display: block;
                max-width: 100%;
                margin: 20px auto;
                padding: 20px;
            }

            .form-actions {
                justify-content: center;
            }
        }
    </style>
</head>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
    {{ $errors->first() }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="user-container">
    <div class="user-header">
        <h2>Add New User</h2>
    </div>

    <form id="addUserForm" action="{{ route('add-user-post') }}" method="POST" class="add-user-form">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }} "required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}" required>
            <span class="toggle-password" onclick="togglePassword()" style="position: absolute; right: 10px; top: 32px; cursor: pointer;">
                <i class="fa-solid fa-eye" id="eyeIcon"></i>
            </span>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"required pattern="[0-9]*" inputmode="numeric">
        </div>

        <div class="form-group" style="grid-column: span 2;">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}"required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="staff">Customer</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save"><i class="fa-solid fa-user-plus"></i> Add User</button>
            <a href="{{ route('user') }}" class="btn cancel">Cancel</a> 
        </div>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('phone').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    // document.addEventListener('DOMContentLoaded', function () {
    //     const form = document.getElementById('addUserForm');

    //     form.addEventListener('submit', function (event) {
    //         const inputs = form.querySelectorAll('input[required], select[required]');
    //         let isEmpty = false;

    //         inputs.forEach(function (input) {
    //             if (!input.value.trim()) {
    //                 isEmpty = true;
    //                 input.classList.add('input-error');
    //             } else {
    //                 input.classList.remove('input-error');
    //             }
    //         });

    //         if (isEmpty) {
    //             event.preventDefault();
    //             alert('Please fill in all required fields.');
    //         } else {
    //             const confirmSubmit = confirm('Are you sure you want to submit this form?');
    //             if (!confirmSubmit) {
    //                 event.preventDefault();
    //             }
    //         }
    //     });
    // });
</script>
@endsection
