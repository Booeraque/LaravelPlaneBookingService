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
        $user = auth()->user();
        return view('profile-edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'name' => 'required|string|max:50',
        ]);

        $user = Auth::user();
        $user->update($request->only('username', 'email', 'name'));

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
