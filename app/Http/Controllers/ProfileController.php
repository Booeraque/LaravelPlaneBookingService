<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $userType = $user->customer ? 'customer' : 'worker';
        return view('profile', compact('user', 'userType'));
    }

    public function edit()
    {
        return view('profile-edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('username', 'email', 'name'));

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
