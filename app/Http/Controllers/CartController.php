<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = 1;

        $cart = Cart::with(['details.product'])
            ->where('users_id', $userId)
            ->where('carts_status_del', false)
            ->first();

        return view('user.cart', [
            'cartItems' => $cart ? $cart->details : collect()
        ]);
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $productPrice = $request->input('product_price');
        $userId = 1; // nanti ganti auth()->id()

        if (!$productId) {
            $title = $request->input('product_name');
            $author = $request->input('product_author');

            $product = Product::where('products_title', $title)
                ->where('products_author_name', $author)
                ->first();

            if (!$product) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Produk tidak ditemukan'], 404);
                }
                return redirect()->back()->with('error', 'Produk tidak ditemukan di database.');
            }

            $productId = $product->id;
        }

        $cart = Cart::firstOrCreate(
            ['users_id' => $userId, 'carts_status_del' => false],
            ['carts_id' => strtoupper(Str::random(16))]
        );

        $detail = CartDetail::where('carts_id', $cart->carts_id)
            ->where('products_id', $productId)
            ->where('cart_details_status_del', false)
            ->first();

        if ($detail) {
            $detail->increment('cart_details_amount');
        } else {
            CartDetail::create([
                'carts_id' => $cart->carts_id,
                'products_id' => $productId,
                'cart_details_price' => $productPrice,
                'cart_details_amount' => 1,
                'cart_details_status_del' => false,
            ]);
        }

        // Hitung jumlah produk unik di cart
        $count = CartDetail::where('carts_id', $cart->carts_id)
            ->where('cart_details_status_del', false)
            ->count();

        if ($request->ajax()) {
            return response()->json(['count' => $count]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function remove($id)
    {
        $item = CartDetail::findOrFail($id);
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang!');
    }

    public function update(Request $request, $id)
    {
        $detail = CartDetail::findOrFail($id);

        $action = $request->input('action');
        $quantity = (int) $request->input('quantity', 1);

        if ($action === 'increment') {
            $detail->increment('cart_details_amount');
        } elseif ($action === 'decrement') {
            if ($detail->cart_details_amount > 1) {
                $detail->decrement('cart_details_amount');
            }
        } else {
            if ($quantity >= 1) {
                $detail->update(['cart_details_amount' => $quantity]);
            }
        }

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $userId = 1; // ganti pakai Auth::id() kalau sudah login

        // Ambil cart aktif beserta detail dan produk
        $cart = Cart::with(['details.product'])
            ->where('users_id', $userId)
            ->where('carts_status_del', false)
            ->first();

        if (!$cart || $cart->details->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong!');
        }

        $totalPrice = $cart->details->sum(function ($item) {
            return $item->cart_details_price * $item->cart_details_amount;
        });

        // Buat invoice number unik
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat parameter transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $invoiceNumber,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => 'Guest Customer',
                'email' => 'guest@example.com',
            ],
            'callbacks' => [
                'finish' => route('payment.return', $invoiceNumber),
            ]
        ];

        try {
            $snapUrl = Snap::createTransaction($params)->redirect_url;

            // Tandai item keranjang sudah diproses, misalnya dengan soft delete
            foreach ($cart->details as $detail) {
                $detail->cart_details_status_del = true;
                $detail->save();
            }

            // Atau bisa hapus semua detail langsung:
            // $cart->details()->delete();

            return redirect()->away($snapUrl);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
            dd($e->getMessage());
        }
    }
}
