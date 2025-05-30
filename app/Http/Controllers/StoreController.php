<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    //

    public function store(Request $request)
    {
        try {
            // Your validation & insertion logic

            // Redirect with success
            return redirect()->route('product')->with('success', 'Book uploaded successfully!');
        } catch (\Exception $e) {
            // Redirect back with error
            return back()->withInput()->with('error', 'Failed to upload book. Please try again.');
        }
    }
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

    public function show_add_product_post(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'products_title' => 'required|string|max:255',
            'products_author_name' => 'required|string|max:255',
            'products_publisher_name' => 'required|string|max:255',
            'products_published_year' => 'required|digits:4|integer',
            'products_price' => 'required|numeric',
            'products_stock' => 'required|integer',
            'products_summary' => 'required|string',            
            'products_isbn' => 'required|string|max:255',       
            'products_total_pages' => 'required|string|max:255',
            'products_languange' => 'required|string|max:255',  
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $totalPages = $request->products_total_pages . ' halaman';
        // Save product
        $product = Product::create([
            'products_title' => $request->products_title,
            'products_author_name' => $request->products_author_name,
            'products_publisher_name' => $request->products_publisher_name,
            'products_published_year' => $request->products_published_year,
            'products_price' => $request->products_price,
            'products_stock' => $request->products_stock,
            'products_summary' => $request->products_summary,
            'products_isbn' => $request->products_isbn,
            'products_total_pages' => $request->products_total_pages,
            'products_languange' => $request->products_languange,
        ]);

        // Attach categories
        foreach ($request->categories as $categoryId) {
            DB::table('category_product')->insert([
                'products_id' => $product->id,
                'categories_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Handle images
        if ($request->hasFile('product_images')) {
            $images = array_values($request->file('product_images')); // reset index

            foreach ($images as $index => $image) {
                $imageName = $product->id . '.' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img'), $imageName);

                // Save to DB
                DB::table('product_images')->insert([
                    'product_images_url' => 'img/' . $imageName,
                    'product_images_is_primary' => $index === 0 ? 1 : 0,
                    'products_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return redirect()->route('product')->with('success', 'Product added successfully!');
    }

    public function show_edit_product_post(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
            'products_title' => 'required|string|max:255',
            'products_author_name' => 'required|string|max:255',
            'products_publisher_name' => 'required|string|max:255',
            'products_published_year' => 'required|digits:4|integer',
            'products_price' => 'required|numeric',
            'products_stock' => 'required|integer',
            'products_summary' => 'required|string',
            'products_isbn' => 'required|string|max:255',
            'products_total_pages' => 'required|string|max:255',
            'products_languange' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'existing_photos_to_delete' => 'array',
            'existing_photos_to_delete.*' => 'integer|exists:product_images,id',
        ]);

        // Find product
        $product = Product::findOrFail($request->id);

        // Delete selected existing images
        if ($request->has('existing_photos_to_delete')) {
            foreach ($request->existing_photos_to_delete as $photoId) {
                $photo = ProductImage::find($photoId);
                if ($photo) {
                    $photoPath = public_path($photo->product_images_url);

                    // Delete physical file if exists
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }

                    // Delete DB record
                    $photo->delete();
                }
            }
        }

        // Update product info
        $product->update([
            'products_title' => $request->products_title,
            'products_author_name' => $request->products_author_name,
            'products_publisher_name' => $request->products_publisher_name,
            'products_published_year' => $request->products_published_year,
            'products_price' => $request->products_price,
            'products_stock' => $request->products_stock,
            'products_summary' => $request->products_summary,
            'products_isbn' => $request->products_isbn,
            'products_total_pages' => $request->products_total_pages,
            'products_languange' => $request->products_languange,
        ]);

        // Sync categories
        $product->categories()->sync($request->categories);

        return redirect()->route('product')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Soft delete
        return redirect()->route('product')->with('success', 'Book deleted successfully!');
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
        $categoryId = $request->input('category');

        $products = Product::query()
            ->whereNull('deleted_at') // ✅ Exclude soft-deleted products
            ->when($search, function ($query, $search) {
                $query->where('id', $search)
                    ->orWhere('products_title', 'like', "%$search%")
                    ->orWhere('products_author_name', 'like', "%$search%");
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->whereHas('categories', function ($catQuery) use ($categoryId) {
                    $catQuery->where('categories.id', $categoryId);
                });
            })
            ->select('id', 'products_title', 'products_author_name', 'products_price', 'products_stock')
            ->paginate(10);

        $categories = Category::all(['id', 'categories_name']);

        return view('admin.product', compact('title', 'products', 'categories'));
    }

    public function show_edit_product($id)
    {
        $title = 'Product';
        $product = Product::with('categories')->findOrFail($id); 
        $categories = Category::all();

        return view('admin.edit-product', compact('title', 'product', 'categories'));
    }

    public function show_category(Request $request)
    {
        $title = 'Category';

        // Handle deletion
        if ($request->has('delete_id')) {
            $deleteId = $request->input('delete_id');
            Category::destroy($deleteId);
        }

        // Eager load the related products
        $categories = Category::with('products')->get();

        return view('admin.category', compact('title', 'categories'));
        
        }
    }


