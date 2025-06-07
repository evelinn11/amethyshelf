<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cart = Cart::where('users_id', $userId)
            ->where('carts_status_del', false)
            ->latest()
            ->first();

        $cartItems = $cart
            ? CartDetail::where('carts_id', $cart->carts_id)
                ->where('cart_details_status_del', false)
                ->with('product.primaryImage')
                ->get()
            : collect();

        return view('user.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $productPrice = $request->input('product_price');
        $quantity = (int) $request->input('quantity', 1);
        $userId = Auth::id(); // GANTI: gunakan user login

        if (!$userId) {
            return redirect()->route('signin.show')->with('error', 'Silakan login terlebih dahulu.');
        }

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
            $detail->increment('cart_details_amount', $quantity);
        } else {
            CartDetail::create([
                'carts_id' => $cart->carts_id,
                'products_id' => $productId,
                'cart_details_price' => $productPrice,
                'cart_details_amount' => $quantity,
                'cart_details_status_del' => false,
            ]);
        }

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
        $userId = Auth::id();
        $item = CartDetail::where('id', $id)
            ->whereHas('cart', function($q) use ($userId) {
                $q->where('users_id', $userId);
            })
            ->firstOrFail();
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang!');
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $detail = CartDetail::where('id', $id)
            ->whereHas('cart', function($q) use ($userId) {
                $q->where('users_id', $userId);
            })
            ->firstOrFail();

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
        $userId = Auth::id(); // nanti pakai Auth::id() kalau sudah login

        $cart = Cart::with('details')->where('users_id', $userId)->where('carts_status_del', false)->first();

        if (!$cart || $cart->details->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $totalPrice = $cart->details->sum(fn($item) => $item->cart_details_price * $item->cart_details_amount);

            $transactions = Transaction::create([
                'users_id' => $userId,
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'payment_method' => null,
                'total_amount' => $totalPrice,
                'order_status' => 'pending',
                'payment_url' => null,
            ]);

            foreach ($cart->details as $detail) {
                TransactionDetail::create([
                    'transaction_id' => $transactions->id,
                    'product_id' => $detail->products_id,
                    'quantity' => $detail->cart_details_amount,
                    'unit_price' => $detail->cart_details_price,
                    'subtotal' => $detail->cart_details_price * $detail->cart_details_amount,
                ]);
            }

            // Midtrans Config
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $transactions->invoice_number,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => 'Guest',
                    'email' => 'guest@example.com',
                ],
                'callbacks' => [
                    'finish' => route('payment.return', $transactions->id),
                ],
            ];

            $snapUrl = Snap::createTransaction($params)->redirect_url;

            $transactions->payment_url = $snapUrl;
            $transactions->save();

            // Tandai cart sudah selesai atau hapus jika mau
            $cart->carts_status_del = true;
            $cart->save();

            DB::commit();

            return redirect()->away($snapUrl);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
