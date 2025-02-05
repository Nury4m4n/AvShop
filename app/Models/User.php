<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }
    public function umrohPackages()
    {
        return $this->hasMany(UmrahPackage::class);
    }
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    public function carousels()
    {
        return $this->hasMany(Carousel::class);
    }
    // public function promos()
    // {
    //     return $this->hasMany(Promo::class);
    // }
}