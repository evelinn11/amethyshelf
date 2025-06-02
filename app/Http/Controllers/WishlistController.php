<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $cart = session()->get('cart', []);

    if (isset($wishlist[$index])) {
        $item = $wishlist[$index];

        // Tambahkan quantity saat masuk ke cart
        $cart[] = [
            'title' => $item['title'],
            'author' => $item['author'],
            'price' => $item['price'],
            'image' => $item['image'],
            'quantity' => 1,
        ];

        session(['cart' => $cart]);
    }

    return redirect()->route('wishlist.index')->with('success', 'Item berhasil ditambahkan ke cart!');
    }

}