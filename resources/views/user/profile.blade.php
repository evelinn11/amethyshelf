@extends('user.base.base')

@push('styles')
    <style>
        .profile-container {
            max-width: 700px;
            margin: 3rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(60, 19, 97, 0.1);
            font-family: 'Segoe UI', sans-serif;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-header h2 {
            font-size: 2rem;
            color: #3C1361;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr 2fr;
            row-gap: 1rem;
            column-gap: 1rem;
        }

        .profile-info label {
            font-weight: bold;
            color: #3C1361;
            text-align: right;
        }

        .profile-info div {
            color: #555;
        }

        .profile-actions {
            text-align: center;
            margin-top: 2.5rem;
        }

        .profile-actions a,
        .profile-actions button {
            margin: 0.4rem;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-purple {
            background-color: #3C1361;
            color: white;
            padding-top:10px;
            padding-bottom:15px;
        }

        .btn-purple:hover {
            background-color: #5936a2;
        }

        .btn-red {
            background-color: #dc3545;
            color: white;
        }

        .btn-red:hover {
            background-color: #bb2d3b;
        }

        @media (max-width: 600px) {
            .profile-info {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .profile-info label {
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <h2>User Profile</h2>
        </div>

        <div class="profile-info">
            <label>Name:</label>
            <div>{{ Auth::user()->name }}</div>

            <label>Email:</label>
            <div>{{ Auth::user()->email }}</div>

            <label>Phone Number:</label>
            <div>{{ Auth::user()->phone_number }}</div>

            <label>Address:</label>
            <div>{{ Auth::user()->address }}</div>

            <label>Role:</label>
            <div>
                @if(Auth::user()->role === '1')
                    Admin
                @else
                    Customer
                @endif
            </div>

            <label>Status:</label>
            <div>
                {{ Auth::user()->status_del ? 'Inactive' : 'Active' }}
            </div>
        </div>

        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn-purple">Edit Profile</a>

            <form action="{{ route('signout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-red">Logout</button>
            </form>
        </div>
    </div>
@endsection
