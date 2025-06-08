<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function show()
    {
        return view('user.profile');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . Auth::id(),
            'address' => 'nullable|max:150',
            'phone_number' => 'nullable|max:15',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email', 'address', 'phone_number'));

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
