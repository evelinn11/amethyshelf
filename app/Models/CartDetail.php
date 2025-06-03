<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_details';

    protected $fillable = [
        'carts_id',
        'products_id',
        'cart_details_price',
        'cart_details_amount',
        'cart_details_status_del',
    ];

    public function product()
    {
        // Relasi ke product, untuk ambil data produk lengkap
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'carts_id', 'carts_id');
    }
}