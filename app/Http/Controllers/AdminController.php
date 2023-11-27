<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequests\UserStoreRequest;
use App\Http\Requests\AdminRequests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function store(UserStoreRequest $request): JsonResponse{
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        $user->assignRole($validatedData['role']);

        return response()->json(['message' => 'User created, role assigned'], 201);

    }
    public function update(User $user, UserUpdateRequest $request): JsonResponse{

        $validatedData = $request->validated();
        $user->update($validatedData);

        if($validatedData['role']){
            $user->assignRole($validatedData['role']);
        }
        return response()->json(['message' => 'User updated'], 201);
    }
    public function destroy(User $user){
        $user->delete();
        return response()->json(['message' => 'User deleted'], 201);

    }
}
