<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $topBooks = DB::table('products')
            ->join('transaction_details', 'products.id', '=', 'transaction_details.product_id')
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.products_id')
                    ->where('product_images.product_images_is_primary', '=', 1);
            })
            ->select(
                'products.id',
                'products.products_title',
                'products.products_author_name',
                'product_images.product_images_url',
                DB::raw('SUM(transaction_details.quantity) as total_sold')
            )
            ->groupBy('products.id', 'products.products_title', 'products.products_author_name', 'product_images.product_images_url')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

            $editorsPickBooks = Product::with('primaryImage')
                ->where('products_published_year', Carbon::now()->year)
                ->orderBy('products_published_year', 'desc')
                ->take(10)
                ->get();
        return view('user.home', compact('categories', 'iconMap', 'topBooks', 'editorsPickBooks'));
    }
}
