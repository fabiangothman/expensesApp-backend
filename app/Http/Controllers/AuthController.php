<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validation = validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        return $validation;
    }
}
