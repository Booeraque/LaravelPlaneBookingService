<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartPlane extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'plane_id',
    ];

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }
}
