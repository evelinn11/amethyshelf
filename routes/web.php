<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\EmailVerificationController;

// INI PUNYA FELI

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/category/{id}', [ProductController::class, 'showByCategory'])->name('products.showByCategory');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/search-redirect', [ProductController::class, 'redirectToProductDetail'])->name('search.redirect');

//BARU CELIN
Route::post('/add-product-post', [StoreController::class, 'show_add_product_post'])
-> name('add-product-post');

Route::post('/edit-product-post', [StoreController::class, 'show_edit_product_post'])
-> name('edit-product-post');

// INI PUNYA FELI




Route::get('/home', [HomeController::class, 'show'])->name('home.show');

Route::get('/products', [ProductController::class, 'show'])->name('products.show');

Route::get('/product-details', [ProductController::class, 'details'])->name('product.details');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/payment-status', [CartController::class, 'paymentStatus'])->name('payment.status');

Route::post('/cart/checkout', function () {
    return redirect()->route('payment.status')->with('success', 'Checkout successful!');
})->name('cart.checkout');

Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');

Route::get('/orders/{id}/details', [OrderController::class, 'details'])->name('order.details');



// DIBAWAH INI ADMIN

Route::get('/dashboard', [StoreController::class, 'show_dash'])
-> name('dashboard');

Route::get('/add-product', [StoreController::class, 'show_add_product'])
-> name('add-product');

Route::get('/product', [StoreController::class, 'show_product'])
-> name('product');

Route::get('/edit-product', [StoreController::class, 'show_edit_product'])
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

Route::get('/admin-order-details', [StoreController::class, 'show_order_details'])
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
