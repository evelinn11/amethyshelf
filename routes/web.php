<?php

use App\Http\Controllers\AboutController;
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
use App\Http\Controllers\AdminSignUpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;

//coba test kirim email
Route::get('/test-email', function () {
    Mail::raw('Ini adalah email test', function ($message) {
        $message->to('tjandravarrel@gmail.com')
            ->subject('Test Email dari Laravel');
    });

    return 'Email telah dikirim!';
});

// Route publik (bisa diakses tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/category/{id}', [ProductController::class, 'showByCategory'])->name('products.showByCategory');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products', [ProductController::class, 'show'])->name('products.show');
Route::get('/produk/detail', [ProductController::class, 'details'])->name('details');
Route::get('/home', [HomeController::class, 'index'])->name('home.show');
Route::get('/search-redirect', [ProductController::class, 'redirectToProductDetail'])->name('search.redirect');
Route::get('/about', [AboutController::class, 'show'])->name('about');


// Route auth (login, signup, lupa password)
Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignUpController::class, 'show'])->name('signup.show');
    Route::post('/signup', [SignUpController::class, 'signup'])->name('signup.store');
    Route::get('/signin', [AuthController::class, 'show'])->name('signin.show');
    Route::post('/signin_auth', [AuthController::class, 'signin_auth'])->name('signin.auth');
    Route::get('/changepassword', [ForgetPasswordController::class, 'showChangePassword'])->name('changepassword.show');
    Route::post('/changepassword', [ForgetPasswordController::class, 'changePassword'])->name('changepassword.save');
    Route::get('/forgetpassword', [ForgetPasswordController::class, 'show'])->name('forgetpassword.show');
    Route::post('/forgetpassword', [ForgetPasswordController::class, 'sendVerification'])->name('forgetpassword.send');
});

Route::post('/signout', [AuthController::class, 'signout'])->name('signout');

// Route khusus user (role:U) - tidak bisa akses admin
Route::middleware(['auth', 'role:U'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{index}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/details', [OrderController::class, 'details'])->name('order.details');
    Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{index}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/add-to-cart/{index}', [WishlistController::class, 'addToCart'])->name('wishlist.addToCart');
    Route::post('/wishlist/move-to-cart/{index}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/payment/return/{transactions}', [PaymentController::class, 'handleReturn'])->name('payment.return');
    Route::get('/payment/status/{transactions}', [PaymentController::class, 'checkStatus'])->name('payment.status');
    Route::post('/transactions/{transaction}/cancel', [PaymentController::class, 'cancelTransaction'])->name('transactions.cancel');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Route khusus admin bisa akses semua route user + admin
Route::middleware(['auth', 'role:A'])->group(function () {
    // Semua route user (eror klo nyalakan jadi forbidden))
    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    // Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::put('/cart/update/{index}', [CartController::class, 'update'])->name('cart.update');
    // Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');
    // Route::get('/orders/{id}/details', [OrderController::class, 'details'])->name('order.details');
    // Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.index');
    // Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    // Route::post('/wishlist/remove/{index}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    // Route::post('/wishlist/add-to-cart/{index}', [WishlistController::class, 'addToCart'])->name('wishlist.addToCart');
    // Route::post('/wishlist/move-to-cart/{index}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    // Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    // Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    // Route::get('/payment/return/{transactions}', [PaymentController::class, 'handleReturn'])->name('payment.return');
    // Route::get('/payment/status/{transactions}', [PaymentController::class, 'checkStatus'])->name('payment.status');
    // Route::post('/transactions/{transaction}/cancel', [PaymentController::class, 'cancelTransaction'])->name('transactions.cancel');

    // Semua route admin
    Route::get('/admin/signup', [AdminSignUpController::class, 'show'])->name('admin.signup.show');
    Route::post('/admin/signup', [AdminSignUpController::class, 'signup'])->name('admin.signup.submit');
    Route::post('/add-product-post', [StoreController::class, 'show_add_product_post'])->name('add-product-post');
    Route::post('/edit-product-post', [StoreController::class, 'show_edit_product_post'])->name('edit-product-post');
    Route::delete('/delete-product/{id}', [StoreController::class, 'delete_product'])->name('delete-product');
    Route::get('/dashboard', [StoreController::class, 'show_dash'])->name('dashboard');
    Route::get('/add-product', [StoreController::class, 'show_add_product'])->name('add-product');
    Route::get('/product', [StoreController::class, 'show_product'])->name('product');
    Route::get('/edit-product/{id}', [StoreController::class, 'show_edit_product'])->name('edit-product');
    Route::get('/category', [StoreController::class, 'show_category'])->name('category');
    Route::get('/add-category', [StoreController::class, 'show_add_category'])->name('add-category');
    Route::get('/edit-category', [StoreController::class, 'show_edit_category'])->name('edit-category');
    Route::get('/admin-orders', [StoreController::class, 'show_orders'])->name('admin-orders');
    Route::get('/admin-order-details/{id}', [StoreController::class, 'show_order_details'])->name('admin-order-details');

    //celin add
    Route::get('/user', [StoreController::class, 'show_user'])->name('user');
    Route::get('/add-user', [StoreController::class, 'show_add_user'])->name('add-user');
    Route::get('/edit-user/{id}', [StoreController::class, 'show_edit_user'])->name('edit-user');
    Route::post('/add-user-post', [StoreController::class, 'show_add_user_post'])->name('add-user-post');
    Route::post('/edit-user-post/{id}', [StoreController::class, 'show_edit_user_post'])->name('edit-user-post');
    Route::delete('/delete-user/{id}', [StoreController::class, 'delete_user'])->name('delete-user');

    Route::post('/add-category-post', [StoreController::class, 'show_add_category_post'])->name('add-category-post');
    Route::get('/edit-category/{id}', [StoreController::class, 'show_edit_category'])->name('edit-category');
    Route::post('/edit-category-post/{id}', [StoreController::class, 'show_edit_category_post'])->name('edit-category-post');
    Route::delete('/delete-category/{id}', [StoreController::class, 'delete_category'])->name('delete-category');
});
