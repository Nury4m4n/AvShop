<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function cartsItem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function umrahPackage()
    {
        return $this->belongsTo(UmrahPackage::class);
    }
}
