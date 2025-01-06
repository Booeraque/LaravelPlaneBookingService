<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

        public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        auth()->login($user);

        return redirect()->route('planes.index');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
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
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
        ]);

        $customer = Customer::create([
            'person_id' => $user->id,
            'account_creation_date' => now(),
        ]);

        $shoppingCart = ShoppingCart::create([
            'customer_id' => $customer->id,
        ]);

        $customer->update(['shopping_cart_id' => $shoppingCart->id]);

        return $user;
    }
}
