<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plane;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($planeId)
    {
        $user = Auth::user();
        $customer = $user->customer;

        // Get the latest shopping cart for the customer
        $cart = $customer->shoppingCarts()->latest('id')->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'No shopping cart found.');
        }

        // Add the plane to the latest shopping cart
        $plane = Plane::findOrFail($planeId);
        $cart->planes()->attach($plane);

        return redirect()->route('shopping-cart.show', $cart->id)->with('success', 'Plane added to cart.');
    }

    public function remove($planeId)
    {
        $user = Auth::user();

        if ($user->customer) {
            $customer = $user->customer;

            // Get the latest shopping cart for the customer
            $cart = $customer->shoppingCarts()->latest('id')->first();

            if (!$cart) {
                return redirect()->back()->with('error', 'No shopping cart found.');
            }

            // Remove the plane from the latest shopping cart
            $plane = Plane::findOrFail($planeId);
            $cart->planes()->detach($plane);

            return redirect()->route('shopping-cart.show', $cart->id)->with('success', 'Plane removed from cart.');
        } elseif ($user->worker) {
            // Check if the worker is associated with any bookings containing the plane
            $booking = $user->worker->bookings()->whereHas('shoppingCart.planes', function ($query) use ($planeId) {
                $query->where('planes.id', $planeId);
            })->first();

            if (!$booking) {
                return redirect()->back()->with('error', 'No booking found with the specified plane.');
            }

            // Remove the plane from the booking's shopping cart
            $plane = Plane::findOrFail($planeId);
            $booking->shoppingCart->planes()->detach($plane);

            return redirect()->route('bookings.edit', $booking->id)->with('success', 'Plane removed from booking.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
