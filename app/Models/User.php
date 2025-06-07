<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'password', 'role', 'address', 'phone_number', 'status_del'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'users_id');
    }
}
