<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Worker;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(6); // Ensure pagination is used
        return view('users.index', compact('users'));
    }

        public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'confirmed'
            ],
            'name' => 'required|string|min:3|max:50',
            'role' => 'required|in:customer,worker',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($request->role === 'customer') {
            $customer = Customer::create([
                'person_id' => $user->id,
                'account_creation_date' => now(),
            ]);

            $shoppingCart = ShoppingCart::create([
                'customer_id' => $customer->id,
            ]);

            $customer->shopping_cart_id = $shoppingCart->id;
            $customer->save();
        } elseif ($request->role === 'worker') {
            Worker::create([
                'person_id' => $user->id,
                'date_of_employment' => now(),
                'is_admin' => 0,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'min:6',
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'confirmed'
            ],
            'name' => 'required|string|min:3|max:50',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->filled('current_password') && $request->filled('password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
        }

        $user->save();

        return redirect()->route('users.show', $user->id)
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

        protected function validator(array $data, $id = null)
    {
        $rules = [
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => [
                'nullable',
                'string',
                'min:6',
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'confirmed'
            ],
            'name' => 'required|string|min:3|max:50',
        ];

        return Validator::make($data, $rules);
    }
}
