<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function index()
    {
        $planes = Plane::paginate(6); // Ensure pagination is used
        $isAdmin = auth()->user()->worker && auth()->user()->worker->is_admin;
        return view('planes', compact('planes', 'isAdmin'));
    }

    public function show($id)
    {
        $plane = Plane::findOrFail($id);
        $user = auth()->user();
        $userType = auth()->user()->customer ? 'customer' : 'worker';
        $inCart = $user && $user->customer
            && $user->customer->shoppingCarts()->latest('id')->first()
            && $user->customer->shoppingCarts()->latest('id')->first()->planes->contains($plane->id);

        return view('plane-details', compact('plane', 'inCart', 'userType'));
    }

    public function edit($id)
    {
        $plane = Plane::findOrFail($id);
        return view('planes.edit', compact('plane'));
    }

    public function update(Request $request, $id)
    {
        $plane = Plane::findOrFail($id);
        $plane->update($request->all());

        return redirect()->route('planes.show', $plane->id)
            ->with('success', 'Plane updated successfully.');
    }

        public function destroy($id)
    {
        $plane = Plane::findOrFail($id);
        $plane->delete();

        return redirect()->route('planes.index')->with('success', 'Plane deleted successfully.');
    }
}

