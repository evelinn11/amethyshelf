<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        $wishlist[] = [
            'title' => $request->product_name,
            'author' => $request->product_author,
            'price' => $request->product_price,
            'image' => $request->product_image,
        ];

        session(['wishlist' => $wishlist]);

        return redirect()->route('wishlist.index')->with('success', 'Produk ditambahkan ke wishlist!');
    }

    public function show()
    {
        $wishlist = session()->get('wishlist', []);
        return view('user.wishlist', compact('wishlist'));
    }

    public function remove($index)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$index])) {
            unset($wishlist[$index]);
            // Reindex array supaya key-nya rapi
            $wishlist = array_values($wishlist);
            session(['wishlist' => $wishlist]);
        }

        return redirect()->route('wishlist.index')->with('success', 'Produk dihapus dari wishlist!');
    }

    public function moveToCart($index)
    {
        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$index])) {
            return redirect()->route('wishlist.index')->with('error', 'Item tidak ditemukan di wishlist.');
        }

        $item = $wishlist[$index];

        // Cari product_id berdasarkan title, atau kamu bisa kirim product_id juga dari frontend
        $product = Product::where('products_title', $item['title'])->first();

        if (!$product) {
            return redirect()->route('wishlist.index')->with('error', 'Produk tidak ditemukan di database.');
        }

        // Simpan ke tabel cart di database

        $cart = Cart::firstOrCreate(
            [
                'users_id' => 2,
                'carts_status_del' => false
            ],
            ['carts_id' => strtoupper(Str::random(16))]
        );

        $detail =CartDetail::where('carts_id', $cart->carts_id)
            ->where('products_id', $product->id)
            ->where('cart_details_status_del', false)
            ->first();

        if ($detail) {
            $detail->increment('cart_details_amount');
        } else {
            CartDetail::create([
                'carts_id' => $cart->carts_id,
                'products_id' => $product->id,
                'cart_details_price' => $product->products_price,
                'cart_details_amount' => 1,
                'cart_details_status_del' => false,
            ]);
        }

        // Hapus item dari session wishlist
        unset($wishlist[$index]);
        $wishlist = array_values($wishlist);
        session(['wishlist' => $wishlist]);

        return redirect()->route('wishlist.index')->with('success', 'Item berhasil ditambahkan ke cart!');
    }


    public function toggle(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        $index = collect($wishlist)->search(function ($item) use ($request) {
            return $item['title'] === $request->product_name;
        });

        if ($index !== false) {
            // Jika sudah ada, hapus
            unset($wishlist[$index]);
            $wishlist = array_values($wishlist);
            session(['wishlist' => $wishlist]);
            return back()->with('success', 'Produk dihapus dari wishlist!');
        } else {
            // Jika belum ada, tambahkan
            $wishlist[] = [
                'title' => $request->product_name,
                'author' => $request->product_author,
                'price' => $request->product_price,
                'image' => $request->product_image,
            ];
            session(['wishlist' => $wishlist]);
            return back()->with('success', 'Produk ditambahkan ke wishlist!');
        }
    }
}
