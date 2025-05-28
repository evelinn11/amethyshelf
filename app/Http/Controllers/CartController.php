<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    // Data dummy awal
    protected $dummyCart = [
        1 => [
            'id' => 1,
            'name' => 'Bumi Manusia',
            'author' => 'Pramoedya Ananta Toer',
            'price' => 100000,
            'quantity' => 1,
            'image' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
        ],
        2 => [
            'id' => 2,
            'name' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'price' => 120000,
            'quantity' => 2,
            'image' => 'https://covers.openlibrary.org/b/id/8231856-L.jpg',
        ],
    ];

    public function index(Request $request)
    {
        // Kalau belum ada cart atau cart kosong, isi ulang dengan dummy
        if (!$request->session()->has('cart') || empty($request->session()->get('cart'))) {
            $request->session()->put('cart', $this->dummyCart);
        }

        $cart = $request->session()->get('cart');

        return view('user.cart', compact('cart'));
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        // TODO: Hapus dari wishlist
        return back()->with('success', 'Item berhasil dihapus.');
    }

    public function checkout(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('payment.status')->with('success', 'Checkout berhasil!');
    }

    public function paymentStatus()
    {
        return view('user.payment');
    }
}
