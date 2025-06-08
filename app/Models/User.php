<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // gunakan table myuser

    protected $fillable = [
        'email', 'password', 'name', 'role', 'address', 'phone_number', 'status_del', 'created_at', 'updated_at'    
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'users_id');
    }

    // Hapus relasi roles(), karena role langsung di field
}
