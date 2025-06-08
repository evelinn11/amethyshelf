@extends('user.base.base')

@push('styles')
    <style>
        .form-container {
            max-width: 600px;
            margin: 4rem auto;
            background: #fff;
            border-radius: 12px;
            padding: 2rem 2.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #3C1361;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 0.4rem;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .btn-purple {
            background-color: #3C1361;
            color: white;
            padding: 0.6rem 1.8rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background-color: #5936a2;
        }

        .btn-red {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-red:hover {
            background-color: #bb2d3b;
        }

        .button-row {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="form-container">
        <h2>Edit Profile</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
            </div>

            <div class="button-row">
                <button type="submit" class="btn-purple">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
