<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productName = $request->input('product_name');
        $productAuthor = $request->input('product_author');
        $productPrice = $request->input('product_price');
        $productImage = $request->input('product_image');

        // Ambil cart dari session, atau inisialisasi array kosong
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di cart berdasarkan title (atau bisa kriteria lain)
        $foundKey = null;
        foreach ($cart as $key => $item) {
            if ($item['name'] === $productName) {
                $foundKey = $key;
                break;
            }
        }

        if ($foundKey !== null) {
            // Produk sudah ada, tambah quantity
            $cart[$foundKey]['quantity'] += 1;
        } else {
            // Produk belum ada, tambah item baru
            $cart[] = [
                'name' => $productName,
                'author' => $productAuthor,
                'price' => (int) $productPrice,
                'image' => asset($productImage), // supaya sesuai dengan blade
                'quantity' => 1,
            ];
        }

        // Simpan kembali ke session
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }


    public function remove($index)
    {   
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reset index
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang!');
    }

    public function update(Request $request, $index)
    {
    $cart = session('cart', []);

    if (!isset($cart[$index])) {
        return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang.');
    }

    $action = $request->input('action');
    $quantity = (int) $request->input('quantity', 1);

    if ($action === 'increment') {
        $cart[$index]['quantity'] += 1;
    } elseif ($action === 'decrement') {
        if ($cart[$index]['quantity'] > 1) {
            $cart[$index]['quantity'] -= 1;
        }
    } else {
        // Jika manual input quantity
        if ($quantity >= 1) {
            $cart[$index]['quantity'] = $quantity;
        }
    }

    session(['cart' => $cart]);

    return redirect()->route('cart.index');
    }
}