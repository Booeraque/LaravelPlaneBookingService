<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function index()
    {
        $planes = Plane::paginate(10); // Ensure pagination is used
        return view('planes', compact('planes'));
    }

    public function show($id)
    {
        $plane = Plane::findOrFail($id);
        $user = auth()->user();
        $userType = auth()->user()->customer ? 'customer' : 'worker';
        $inCart = $user && $user->customer
            && $user->customer->shoppingCarts()->latest()->first()
            && $user->customer->shoppingCarts()->latest()->first()->planes->contains($plane->id);

        return view('plane-details', compact('plane', 'inCart', 'userType'));
    }
}

