<?php

namespace App\Http\Controllers;

use const Grpc\STATUS_INTERNAL;
use const Grpc\STATUS_OK;
use const Grpc\STATUS_UNAUTHENTICATED;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors(),
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        } catch (Throwable $error) {
            return response()->json([
                'status' => false,
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function logout() {}
}
