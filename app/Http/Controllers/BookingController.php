<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Worker;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
    {
        public function index()
        {
            $user = auth()->user();
            $bookings = $user->customer->bookings()->paginate(6); // Ensure pagination is used
            return view('bookings', compact('bookings'));
        }

        public function show($id)
        {
            $booking = Booking::with('shoppingCart.planes', 'worker.user')->findOrFail($id);
            return view('booking', compact('booking'));
        }

    public function proceed()
    {
        $user = auth()->user();
        $cart = $user->customer->shoppingCarts()->latest('id')->first();
        $workers = Worker::all();

        if (!$cart) {
            return redirect()->route('shopping-cart.show', $user->customer->shoppingCarts()->latest('id')->first()->id)
                ->with('error', 'No shopping cart found.');
        }

        return view('booking-proceed', compact('cart', 'workers'));
    }

    public function confirm(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->customer) {
            return redirect()->back()->with('error', 'User or customer not found.');
        }

        $cart = $user->customer->shoppingCarts()->latest('id')->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'No shopping cart found.');
        }

        $booking = Booking::create([
            'cart_id' => $cart->id,
            'customer_id' => $user->customer->id,
            'worker_id' => $request->worker_id,
            'booking_date' => now(),
            'additional_comments' => $request->additional_comments,
        ]);

        // Update the plane status to unavailable
        foreach ($cart->planes as $plane) {
            $plane->update(['status' => 'unavailable']);
        }

        // Create a new shopping cart for the customer
        $newCart = ShoppingCart::create([
            'customer_id' => $user->customer->id,
        ]);

        // Assign the new shopping cart to the customer
        $user->customer->shopping_cart_id = $newCart->id;
        $user->customer->save();

        return redirect()->route('profile')->with('success', 'Booking confirmed.');
    }

    public function workerBookings()
    {
        $worker = auth()->user()->worker;
        $bookings = $worker->bookings()->paginate(7); // Paginate bookings

        return view('bookings', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::with('shoppingCart.planes', 'worker.user')->findOrFail($id);
        $workers = Worker::all();
        return view('bookings.edit', compact('booking', 'workers'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'worker_id' => $request->worker_id,
            'additional_comments' => $request->additional_comments,
        ]);

        return redirect()->route('bookings.show', $id)->with('success', 'Booking updated successfully.');
    }
}
