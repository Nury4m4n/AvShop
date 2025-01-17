<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'orderer_name',
        'orderer_email',
        'orderer_phone',
        'orderer_address',
        'total_amount',
        'status',
        'resi_number',
        'transaction_id',
        'payment_channel',
        'installment',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
