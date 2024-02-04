<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const GENERAL_TOKEN_NAME = 'general-user-token';
    private const GENERAL_TOKEN_CAPABILITIES = ['*'];
    private const GENERAL_TOKEN_EXPIRATION = '+1 day';

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        // token used for authenticate
        $expirationToken = $this->getExpirationToken();
        $token = $user->createToken($this::GENERAL_TOKEN_NAME, $this::GENERAL_TOKEN_CAPABILITIES, $expirationToken)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
        ], Response::HTTP_ACCEPTED);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember', false))) {
            $auth = Auth::user();
            $user = User::where('email', $auth->email)->first();
            
            // token used for authenticate
            $user->tokens()->where('name', $this::GENERAL_TOKEN_NAME)->delete();
            $expirationToken = $this->getExpirationToken($request->input('remember', false));
            $token = $user->createToken($this::GENERAL_TOKEN_NAME, $this::GENERAL_TOKEN_CAPABILITIES, $expirationToken)->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], Response::HTTP_ACCEPTED);
        }

        return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    public function getExpirationToken($notExpire = false): DateTime | null {
        $expirationToken = null;
        if (!$notExpire) {
            $currentDate = new DateTime();
            $expirationToken = $currentDate->modify($this::GENERAL_TOKEN_EXPIRATION);
        }
        return $expirationToken;
    }
}
