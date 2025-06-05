<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'users_id',
        'invoice_number',
        'payment_method',
        'total_amount',
        'order_status',
        'payment_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}