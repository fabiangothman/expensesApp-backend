<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const USER_TOKEN_NAME = 'user';
    private const USER_CAPABILITIES = ['customize'];
    private const TOKEN_EXPIRATION = '+1 day';
    private const ADMIN_TOKEN_NAME = 'admin';
    private const ADMIN_CAPABILITIES = ['manage', 'customize', '*'];

    public function register(Request $request, $onlyUsers = true): JsonResponse {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => ($onlyUsers) ? 'user' : $validated['role'],
        ]);

        $tokenName = constant('self::'.strtoupper($user->role)."_TOKEN_NAME");
        $capabilities = constant('self::'.strtoupper($user->role)."_CAPABILITIES");

        // token used for authenticate
        $expirationToken = $this->getExpirationToken();
        $token = $user->createToken($tokenName, $capabilities, $expirationToken)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request): JsonResponse {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
        ], Response::HTTP_ACCEPTED);
    }

    public function login(Request $request): JsonResponse {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember', false))) {
            $auth = Auth::user();
            $user = User::where('email', $auth->email)->first();

            $tokenName = constant('self::'.strtoupper($user->role)."_TOKEN_NAME");
            $capabilities = constant('self::'.strtoupper($user->role)."_CAPABILITIES");
            
            // token used for authenticate
            $user->tokens()->where('name', $tokenName)->delete();
            $expirationToken = $this->getExpirationToken($request->input('remember', false));
            $token = $user->createToken($tokenName, $capabilities, $expirationToken)->plainTextToken;

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
            $expirationToken = $currentDate->modify($this::TOKEN_EXPIRATION);
        }
        return $expirationToken;
    }
}
