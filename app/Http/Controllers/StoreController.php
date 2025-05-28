<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    //
    public function show_dash()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    public function show_add_product()
    {
        return view('admin.add-product', [
            'title' => 'Add Product'
        ]);
    }

    public function show_home()
    {
        return view('user.home', []);
    }

    public function show_category_books($categoryId)
    {
        $category = Category::with('products')->find($categoryId);
        $title = "Category";

        if (!$category) {
            return redirect()->route('category')->with('error', 'Category not found.');
        }

        $books = $category->products->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->products_title,
                'author' => $book->products_author_name,
                'price' => $book->products_price,
                'stock' => $book->products_stock,
            ];
        });

       return view('admin.category-books', [
        'books' => $books,
        'categoryName' => $category->categories_name,
        'title' => $title
    ]);
    }

    public function show_add_category()
    {
        return view('admin.add-cat', [
            'title' => 'Category'
        ]);
    }
    public function show_edit_category()
    {
        $title = "Category";
        $category = [
            'name' => 'Art & Photography',
            'description' => 'A collection of books that explore creative visual arts, techniques, and the art of photography, inspiring artists and photographers of all levels.'
        ];

        return view('admin.edit-cat', compact('category', 'title'));
    }
        
    public function show_orders()
    {
        $title = 'Orders';

        $orders = [
            ['date' => '10/5/25', 'order_id' => 'T20250510001', 'name' => 'Budi Setiawan', 'total_amount' => 400000, 'status' => 'Completed'],
            ['date' => '10/5/25', 'order_id' => 'T20250510002', 'name' => 'Tina Marini', 'total_amount' => 200000, 'status' => 'Completed'],
            ['date' => '10/5/25', 'order_id' => 'T20250510003', 'name' => 'Fajar Setyo', 'total_amount' => 350000, 'status' => 'Completed'],
        ];
        
        return view('admin.orders', compact('title', 'orders'));
    }

    public function show_order_details()
    {
        return view('admin.order-details', [
            'title' => 'Orders'
        ]);
    }


    public function show_product(Request $request)
    {
        $title = 'Product';
        $search = $request->input('search');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where('id', $search)
                    ->orWhere('products_title', 'like', "%$search%")
                    ->orWhere('products_author_name', 'like', "%$search%");
            })
            ->get(['id', 'products_title', 'products_author_name', 'products_price', 'products_stock']);

        return view('admin.product', compact('title', 'products'));
    }

    public function show_edit_product()
    {
        $title = 'Edit Product';

        $book = [
            'title' => 'Belajar Website untuk Pemula',
            'year' => 2022,
            'category' => 'Non-Fiksi',
            'description' => 'Panduan belajar website dari dasar hingga mahir.',
            'author' => 'Celin Celin W.',
            'publisher' => 'Amethyshelf Publishing',
            'price' => 500000,
            'stock' => 100,
            'type' => 'Non-fiction',
            'images' => [
                'belajarweb.jpg'
            ]
        ];

        return view('admin.edit-product', compact('title', 'book'));
    }

    public function show_category(Request $request)
    {
        $title = 'Category';

        // If there's a delete request, delete first
        if ($request->has('delete_id')) {
            $deleteId = $request->input('delete_id');
            Category::destroy($deleteId);
        }

        // Query categories along with count of linked products in category_product table
       $categories = DB::table('categories')
        ->leftJoin('category_product', 'categories.id', '=', 'category_product.categories_id')
        ->select(
            'categories.id',
            'categories.categories_name as nama_category',
            DB::raw('COUNT(category_product.products_id) as total_books')
        )
        ->groupBy('categories.id', 'categories.categories_name')
        ->get();

        return view('admin.category', compact('title', 'categories'));
    }
}
