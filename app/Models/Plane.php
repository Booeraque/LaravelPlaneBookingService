<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        'plane_name',
        'model',
        'capacity',
        'speed',
        'status',
    ];

    public function shoppingCarts()
    {
        return $this->belongsToMany(ShoppingCart::class, 'cart_planes', 'plane_id', 'cart_id');
    }
}
