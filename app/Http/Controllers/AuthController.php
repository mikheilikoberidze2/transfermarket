<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login (LoginRequest $request): JsonResponse{
        if(!auth()->attempt($request->validated())){
            return response()->json(['message' => 'could not login user'], 401);
        }
        else{
            $user = auth()->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'message' => 'User logged in',], 201);
        }
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(['message' => 'User logged out'], 200);
    }
}
