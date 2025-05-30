<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'products_title',
        'products_author_name',
        'products_publisher_name',
        'products_published_year',
        'products_price',
        'products_stock',
        'products_summary',
        'products_isbn',
        'products_total_pages',
        'products_languange',
    ];

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
