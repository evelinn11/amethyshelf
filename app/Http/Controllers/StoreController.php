<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
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
        $totalSales = DB::table('transactions')->sum('total_amount');
        $totalOrders = DB::table('transactions')->count();

        $totalActiveOrders = DB::table('transactions')
            ->whereIn('order_status', ['pending', 'processing'])
            ->count();

        $totalCompletedOrders = DB::table('transactions')
            ->where('order_status', 'completed')
            ->count();

        $recentOrders = Transaction::with(['details', 'user'])
        ->withSum('details', 'quantity')
        ->orderBy('created_at', 'desc')
        ->limit(8)
        ->get();

            return view('admin.dashboard', compact('totalOrders',
                'totalSales', 
                'totalCompletedOrders', 
                'totalActiveOrders',  'recentOrders'),[
                'title' => 'Dashboard'
            ]);
        }

    public function show_add_product()
    {
        return view('admin.add-product', [
            'title' => 'Add Product'
        ]);
    }

    public function show_add_user_post(Request $request)
    {
            $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|digits_between:8,15',
            'address' => 'required|string|max:150',
            'role' => 'required|in:admin,staff',
        ]);

        try {
            $roleChar = $request->role === 'admin' ? 'A' : 'U';

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone,
                'address' => $request->address,
                'role' => $roleChar,
                'status_del' => 0,
            ]);
        } catch (\Exception $e) {
            Log::error('User insert failed: '.$e->getMessage());
            return redirect()->back()->withErrors('Insert failed: '.$e->getMessage());
        }

        return redirect()->route('user')->with('success', 'User successfully added!');
    }

    public function show_edit_user_post(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User updated successfully.');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'User deleted successfully!');
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

    
    public function show_add_category()
    {
        return view('admin.add-cat', [
            'title' => 'Category'
        ]);
    }

    public function show_add_category_post(Request $request)
    {
        $request->validate([
        'categories_name' => 'required|max:35|unique:categories,categories_name',
        'categories_description' => 'required',
        ]);

        Category::create([
            'categories_name' => $request->categories_name,
            'categories_description' => $request->categories_description,
        ]);

        return redirect()->route('category')->with('success', 'Category added successfully.');
    }

    public function show_edit_category($id)
    {
        $title = "Category";
        $category = Category::findOrFail($id);
        $categories = Category::all(); // get all categories

        return view('admin.edit-cat', compact('category', 'title', 'categories'));
    }

    public function show_edit_category_post(Request $request, $id)
    {
       // Validasi input
        $request->validate([
            'name' => 'required|string|max:35',
            'description' => 'required|string',
        ]);

        $category = Category::findOrFail($id);

        // Update data
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        // Redirect kembali ke halaman kategori dengan flash message sukses
        return redirect()->route('category')->with('success', 'Category updated successfully!');
    }


    public function show_orders()
    {
        $title = 'Orders';
        $orders = Transaction::with('user')->orderBy('created_at', 'desc')->get();
        $totalOrders= Transaction::count();
        $pending = Transaction::where('order_status', 'pending')->count();
        $cancelled = Transaction::where('order_status', 'cancelled')->count();
        $completed = Transaction::where('order_status', 'completed')->count();

        return view('admin.orders', compact('orders', 'totalOrders', 'pending', 'cancelled', 'completed'));
    }

    public function show_order_details($id)
    {
        $title = 'Order Details';
        $order = Transaction::with(['user', 'details.product'])->findOrFail($id);

        return view('admin.order-details', compact('title', 'order'));
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

    public function show_user()
    {
        $title = 'User';
        $users = DB::table('users')
        ->where('status_del', 0)
        ->get();

        return view('admin.user', compact('title', 'users'));
    }

    public function show_add_user()
    {
        $title = 'User';

        return view('admin.add-user', compact('title'));
    }

    public function show_edit_user($id)
    {
        $title = 'User';
        $user = User::findOrFail($id);

        return view('admin.edit-user', compact('title', 'user'));
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
        $categoryCount = Category::count(); //

        return view('admin.category', compact('title', 'categories','categoryCount'));
        
        }
    }

    


