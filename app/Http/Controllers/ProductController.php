<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    // public function show()
    // {
    //     return view('user.products');
    // }

    // public function details()
    // {
    //     return view('user.product.details');
    // }

    // ini punya feli

    // ini untuk show product berdasarkan kategori yang diclick di navbar
    public function showByCategory($id)
    {
        $category = Category::findOrFail($id);
        // $products = $category->products()->get(); // ambil semua produk yang punya kategori ini
        $products = $category->products()->with('primaryImage')->get();

        return view('user.products', compact('category', 'products'));
    }

    // ini untuk nampilin product details sesuai product catalog yg di click, beserta rekomendasi
    public function show($id)
    {
        // Ambil produk beserta kategorinya
        $product = Product::with('categories', 'images')->findOrFail($id);

        // Ambil semua ID kategori dari produk tersebut
        $categoryIds = $product->categories->pluck('id');

        $recommendations = Product::with('primaryImage')
        ->whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(10)
        ->get();
        
        return view('user.product.details', compact('product', 'recommendations'));
    }

    // ini utk search di navbar
    public function redirectToProductDetail(Request $request)
    {
        $query = $request->input('q');

        // Cari berdasarkan title produk (case-insensitive)
        $product = Product::where('products_title', 'LIKE', '%' . $query . '%')->first();

        if ($product) {
            return redirect()->route('product.show', ['id' => $product->id]);
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    }


    // ini punya feli
}
