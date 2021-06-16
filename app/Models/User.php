<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'google_id',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function shippings(){
        return $this->hasMany(Shipping::class);
    }
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
