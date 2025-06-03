<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\EmailVerificationController;

// INI PUNYA FELI

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/category/{id}', [ProductController::class, 'showByCategory'])->name('products.showByCategory');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/search-redirect', [ProductController::class, 'redirectToProductDetail'])->name('search.redirect');

// INI PUNYA FELI




// ini cart, wishlist, payment, checkout

Route::get('/home', [HomeController::class, 'show'])->name('home.show');

// Halaman utama diarahkan ke daftar produk
Route::get('/products', [ProductController::class, 'show'])->name('products.show');

// Detail produk
Route::get('/produk/detail', [ProductController::class, 'details'])->name('details');

// Daftar semua produk
//Route::get('/products', [ProductController::class, 'index'])->name('products');

// Halaman Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Tambah item ke cart
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');

// Remove dari cart
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Menambah quantity di cart
Route::put('/cart/update/{index}', [CartController::class, 'update'])->name('cart.update');

Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');

Route::get('/orders/{id}/details', [OrderController::class, 'details'])->name('order.details');

// Show Wishlist
Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist');

Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.index');

// Tambah item dari products ke wishlist
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');

// Remove item dari wishlist
Route::post('/wishlist/remove/{index}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Tambah item dari wishlist ke cart
Route::post('/wishlist/add-to-cart/{index}', [WishlistController::class, 'addToCart'])->name('wishlist.addToCart');

// Move dari wishlist ke cart
Route::post('/wishlist/move-to-cart/{index}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

// Toggle, ubah warna heart wishlist
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

// Checkout
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/payment/status', [PaymentController::class, 'checkStatus'])->name('payment.status');
Route::get('/payment/return', [PaymentController::class, 'handleReturn'])->name('payment.return');

// sementara, loginnya error soalnya
Route::get('/login', function () {
    return redirect()->route('signin.show');
})->name('login');


// DIBAWAH INI ADMIN

//BARU CELIN
Route::post('/add-product-post', [StoreController::class, 'show_add_product_post'])
-> name('add-product-post');

Route::post('/edit-product-post', [StoreController::class, 'show_edit_product_post'])
-> name('edit-product-post');

Route::delete('/product/{id}', [StoreController::class, 'destroy'])->name('product.destroy');
//

Route::get('/dashboard', [StoreController::class, 'show_dash'])
-> name('dashboard');

Route::get('/add-product', [StoreController::class, 'show_add_product'])
-> name('add-product');

Route::get('/product', [StoreController::class, 'show_product'])
-> name('product');

Route::get('/edit-product/{id}', [StoreController::class, 'show_edit_product'])
->name('edit-product');


Route::get('/category', [StoreController::class, 'show_category'])
->name('category');

Route::get('/categorybooks{categoryId}', [StoreController::class, 'show_category_books'])
->name('category-books');

Route::get('/add-category', [StoreController::class, 'show_add_category'])
->name('add-category');

Route::get('/edit-category', [StoreController::class, 'show_edit_category'])
->name('edit-category');

Route::get('/admin-orders', [StoreController::class, 'show_orders'])
->name('admin-orders');

Route::get('/admin-order-details/{id}', [StoreController::class, 'show_order_details'])
->name('admin-order-details');

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'show'])->name('signin.show');
    Route::post('/signin_auth', [AuthController::class, 'signin_auth'])->name('signin.auth');
    Route::get('/signup', [SignUpController::class, 'show'])->name('signup.show');
    Route::post('/signup', [SignUpController::class, 'signup'])->name('signup.store');
    // Sign In -> Email Verification
    Route::get('/emailverification', [EmailVerificationController::class, 'show'])->name('emailverification.show');
    Route::post('/emailverification', [EmailVerificationController::class, 'verify'])->name('emailverification.verify');
    // Email Verification -> Change Password
    Route::get('/changepassword', [ForgetPasswordController::class, 'showChangePassword'])->name('changepassword.show');
    Route::post('/changepassword', [ForgetPasswordController::class, 'changePassword'])->name('changepassword.save');

    Route::get('/forgetpassword', [ForgetPasswordController::class, 'show'])->name('forgetpassword.show');
});

Route::post('/signout',[AuthController::class, 'signout'])->name('signout');
