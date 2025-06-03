<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $primaryKey = 'carts_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['carts_id', 'users_id', 'carts_status_del'];

    public function details()
    {
    return $this->hasMany(CartDetail::class, 'carts_id', 'carts_id')
                ->where('cart_details_status_del', false);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}