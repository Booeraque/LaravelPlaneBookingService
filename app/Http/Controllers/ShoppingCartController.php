<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function show($id)
    {
        $cart = ShoppingCart::with('planes')->findOrFail($id);
        $planes = $cart->planes()->paginate(7); // Paginate planes

        return view('shopping-cart', compact('cart', 'planes'));
    }
}
