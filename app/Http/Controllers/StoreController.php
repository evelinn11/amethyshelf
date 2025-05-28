<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function show_category_books()
    {
        $categoryName = "Arts and Photography";
        $title = 'Category';

        $books = [
            [
                'id' => 'PF001',
                'title' => 'Belajar Website Pemula',
                'author' => 'Celin Celin',
                'price' => 500000,
                'stock' => 100,
            ],
            [
                'id' => 'PF002',
                'title' => 'Desain UI/UX',
                'author' => 'Feli Feli',
                'price' => 450000,
                'stock' => 80,
            ],
            [
                'id' => 'PF003',
                'title' => 'Fotografi Dasar',
                'author' => 'Angel Angel',
                'price' => 300000,
                'stock' => 75,
            ],
            [
                'id' => 'PF004',
                'title' => 'Melukis Indah',
                'author' => 'Evelin Evelin',
                'price' => 300000,
                'stock' => 75,
            ],
            [
                'id' => 'PF005',
                'title' => 'Seni Website',
                'author' => 'Varrel Varrel',
                'price' => 300000,
                'stock' => 75,
            ],
        ];

        return view('admin.category-books', compact('categoryName', 'books', 'title'));
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
        $products = [
            ['id' => 'PF001', 'title' => 'Belajar Website untuk Pemula', 'author' => 'Celin Celin W.', 'price' => 500000, 'stock' => 100],
            ['id' => 'PF002', 'title' => 'Laravel untuk UMKM', 'author' => 'Felicia', 'price' => 350000, 'stock' => 80],
            ['id' => 'PF003', 'title' => 'Dasar-dasar JavaScript', 'author' => 'Angeline', 'price' => 250000, 'stock' => 60],
        ];

        if ($request->has('delete_id')) {
            $deleteId = $request->input('delete_id');
            $products = array_filter($products, fn($book) => $book['id'] != $deleteId);
            $products = array_values($products);
        }

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

        $category = [
            ['id' => 1, 'nama_category' => 'Arts & Photography', 'total_books' => 10],
            ['id' => 2, 'nama_category' => 'Non-Fiksi', 'total_books' => 5],
            ['id' => 3, 'nama_category' => 'Biografi', 'total_books' => 7],
        ];
        // Kalau ada request ID untuk dihapus
        if ($request->has('delete_id')) {
            $deleteId = $request->input('delete_id');
            // Filter data yang tidak sesuai dengan ID yang dihapus
            $category = array_filter($category, function ($cat) use ($deleteId) {
                return $cat['id'] != $deleteId;
            });
            // Reset index array
            $category = array_values($category);
        }
        return view('admin.category', compact('title', 'category'));
    }
}
