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
        return view('planes.index', compact('planes', 'isAdmin'));
    }

    public function show($id)
    {
        $plane = Plane::findOrFail($id);
        $user = auth()->user();
        $userType = auth()->user()->customer ? 'customer' : 'worker';
        $inCart = $user && $user->customer
            && $user->customer->shoppingCarts()->latest('id')->first()
            && $user->customer->shoppingCarts()->latest('id')->first()->planes->contains($plane->id);

        return view('planes.details', compact('plane', 'inCart', 'userType'));
    }

    public function edit($id)
    {
        $plane = Plane::findOrFail($id);
        return view('planes.edit', compact('plane'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plane_name' => 'required|string|min:2|regex:/[A-Z]/',
            'model' => 'required|string|min:2|max:50',
            'capacity' => 'required|integer|min:1|max:100000',
            'speed' => 'required|integer|min:1|max:100000',
            'status' => 'required|string|in:available,unavailable',
        ]);

        $plane = Plane::findOrFail($id);
        $plane->update($request->all());

        return redirect()->route('planes.index')->with('success', 'Plane updated successfully.');
    }

        public function destroy($id)
    {
        $plane = Plane::findOrFail($id);
        $plane->delete();

        return redirect()->route('planes.index')->with('success', 'Plane deleted successfully.');
    }

    public function create()
    {
        return view('planes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plane_name' => 'required|string|min:2|regex:/[A-Z]/',
            'model' => 'required|string|min:2|max:50',
            'capacity' => 'required|integer|min:1|max:100000',
            'speed' => 'required|integer|min:1|max:100000',
            'status' => 'required|string|in:available,unavailable',
        ]);

        Plane::create($request->all());

        return redirect()->route('planes.index')->with('success', 'Plane created successfully.');
    }
}

