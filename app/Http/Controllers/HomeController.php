<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function show(){
        return view('user.home');
    }

    // ini buat dropdown category navbar
    public function index()
    {
        $categories = Category::all();  // Ambil semua data kategori
        return view('user.home', compact('categories'));

    }
}
