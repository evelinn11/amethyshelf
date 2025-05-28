<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $fillable = [
        'product_images_url',
        'product_images_is_primary',
        'products_id'
    ];

    // RELATION TO PRODUCT (many images belong to one product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
