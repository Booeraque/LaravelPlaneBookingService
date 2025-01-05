<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plane;
use App\Models\ShoppingCart;

class CartController extends Controller
{
    public function add(Request $request, Plane $plane)
    {
        $user = auth()->user();
        if (!$user || !$user->customer || !$user->customer->shoppingCarts()->latest()->first()) {
            return redirect()->back()->with('error', 'No shopping cart found.');
        }

        $cart = $user->customer->shoppingCarts()->latest()->first();
        if (!$cart->planes->contains($plane->id)) {
            $cart->planes()->attach($plane->id);
        }
        return redirect()->back()->with('success', 'Plane added to cart.');
    }

    public function remove($planeId)
    {
        $user = auth()->user();

        if ($user->customer) {
            // Customer logic
            $cart = $user->customer->shoppingCarts()->latest()->first();
            if ($cart) {
                $cart->planes()->detach($planeId);
                return redirect()->back()->with('success', 'Plane removed from cart.');
            } else {
                return redirect()->back()->with('error', 'No shopping cart found.');
            }
        } elseif ($user->worker) {
            // Worker logic
            $booking = $user->worker->bookings()->with('shoppingCart')->first();
            if ($booking && $booking->shoppingCart) {
                $booking->shoppingCart->planes()->detach($planeId);
                return redirect()->back()->with('success', 'Plane removed from cart.');
            } else {
                return redirect()->back()->with('error', 'No shopping cart found for the worker.');
            }
        }

        return redirect()->back()->with('error', 'User type not recognized.');
    }
}
