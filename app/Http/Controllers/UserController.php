<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $validation = validator($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        $user = new User();
        $user->name = $validation['name'];
        $user->email = $validation['email'];
        $user->password = Hash::make($validation['password']);
        $user->save();
        return $user;
    }
}
