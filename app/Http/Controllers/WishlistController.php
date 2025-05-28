<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    protected $wishlist;

    public function __construct()
    {
        $this->wishlist = [
            [
                'id' => 1,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'price' => 100000,
                'image' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'price' => 100000,
                'image' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
            ],
        ];
    }

    public function index()
    {
        return view('user.wishlist', ['wishlist' => $this->wishlist]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        // TODO: Tambahkan ke keranjang
        return back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        // TODO: Hapus dari wishlist
        return back()->with('success', 'Item berhasil dihapus dari wishlist.');
    }
}
