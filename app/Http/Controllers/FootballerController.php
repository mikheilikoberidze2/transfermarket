<?php

namespace App\Http\Controllers;

use App\Http\Requests\FootballerRequests\FootballerStoreRequest;
use App\Http\Requests\FootballerRequests\FootballerUpdateRequest;
use App\Http\Resources\FootballerResource;
use App\Models\Footballer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;
use function PHPUnit\Framework\matches;

class FootballerController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Footballer::class,'footballer');
    }

    public function index(){
        $footballer = Footballer::all();
        return FootballerResource::Collection($footballer);
    }
    public function store(FootballerStoreRequest $request)
    {
        $user =  Auth::user();
        $validatedData = $request->validated();
        $userRoles = $user->getRoleNames()->first();

        match ($userRoles)
        {
            'president'=>$user->presidentClub->footballers()->create($validatedData),
            'manager' => $user->managerClub->footballers()->create($validatedData),
        };

        return response()->json(['message' => 'Footballer created'], 201);
    }
    public function show(Footballer $footballer)
    {
        return new FootballerResource($footballer);
    }
    public function update(FootballerUpdateRequest $request, Footballer $footballer)
    {
        $validatedData = $request->validated();
        $footballer->update($validatedData);
        return response()->json(['message' => 'Footballer Updated'], 201);
    }
    public function destroy(Footballer $footballer){
        $footballer->delete();
        return response()->json(['message'=>'Footballer Deleted'],201);
    }
}
