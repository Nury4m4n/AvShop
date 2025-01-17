<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model PackageVariant
    public function packageVariant()
    {
        return $this->belongsTo(PackageVariant::class);
    }

    // Relasi dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
