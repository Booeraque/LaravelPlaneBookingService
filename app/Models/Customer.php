<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends User
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'account_creation_date',
        'shopping_cart_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'person_id');
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class, 'customer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
