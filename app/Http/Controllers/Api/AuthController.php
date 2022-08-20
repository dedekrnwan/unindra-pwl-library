<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->only('name', 'email', 'password');
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|max:50'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'meta' => [
                    'success' => true,
                    'message' => 'User created successfully ',
                ],
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'message' => $e->getMessage(),
                ],
                'data' => null
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'meta' => [
                        'success' => false,
                        'message' => 'Login credentials are invalid.',
                    ],
                    'data' => null
                ], 400);
            }

            return response()->json([
                'meta' => [
                    'success' => true,
                    'message' => 'Token created.',
                ],
                'data' => [
                    'token' => $token
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'message' => $e->getMessage(),
                ],
                'data' => null
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        try {
            $this->validate($request, [
                'token' => 'required'
            ]);

            $user = JWTAuth::authenticate($request->token);
            return response()->json([
                'meta' => [
                    'success' => true,
                    'message' => 'User found',
                ],
                'data' => $user
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'message' => $e->getMessage(),
                ],
                'data' => null
            ], 500);
        }
    }
}
