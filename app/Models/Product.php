<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // RELATION TO CATEGORIES (many to many)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'products_id', 'categories_id');
    }

    // RELATION TO IMAGES (one to many)
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'products_id');
    }

    // public function primaryImage()
    // {
    //     return $this->hasOne(ProductImage::class, 'products_id')
    //                 ->where('product_images_is_primary', 1);
    // }
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'products_id')->where('product_images_is_primary', 1);
    }

}
