<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/planes';

    protected function validator(array $data)
    {
        return Validator::make($data, []);
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
