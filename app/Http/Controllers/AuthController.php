<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use Illuminate\Routing\ResponseFactory;

class AuthController extends Controller
{
    /**
     * Register the user
     */
    public function register(Request $request): Response
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);
        $token = $user->createToken('shoptijger')->plainTextToken;
        return response(['user' => $user, 'token' => $token]);
    }

    /**
     * Log the user in.
     */
    public function login(Request $request): Response
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('shoptijger')->plainTextToken;
        return response(['user' => $user, 'token_type' => 'Bearer', 'token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(Request $request): ResponseFactory|Response
    {
        $user = auth()->user();
        if (!$user) {
            return response(null, 204);
        }
        $user->tokens()->delete();
        return response(null, 204);
    }
}
