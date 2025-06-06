<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ini buat dropdown category navbar
    public function index()
    {
        $categories = Category::all();  // Ambil semua data kategori
        $iconMap = [
            'Academic' => 'fa-graduation-cap',
            'Art & Photography' => 'fa-palette',
            'Business' => 'fa-briefcase',
            'Comic' => 'fa-book',
            'Comedy' => 'fa-laugh',
            'History' => 'fa-landmark',
            'Novel' => 'fa-book-open',
            'Science Fiction' => 'fa-robot',
            'Romance' => 'fa-heart',
            'Self Help' => 'fa-hands-helping',
            'Fiction' => 'fa-book'
        ];

        return view('user.home', compact('categories', 'iconMap'));
    }
}
