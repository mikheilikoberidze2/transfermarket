<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequests\ClubStoreRequest;
use App\Http\Requests\ClubRequests\ClubUpdateReqeust;
use App\Http\Resources\ClubResource;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Club::class, 'club');
    }
    public function index()
    {
        $club = Club::all();
        return ClubResource::collection($club);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClubStoreRequest $request)
        {
            $validatedData = $request->validated();
            $president = Auth::user();
           $president->club()->create($validatedData);
        return response()->json(['message' => 'Club created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        return new ClubResource($club);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClubUpdateReqeust $request,Club $club)
    {
     $validatedData = $request->validated();
        $club->update($validatedData);
     return response()->json(['message'=>'Club Updated'],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        $club->delete();
        return response()->json(['message' => 'Club deleted'], 201);

    }
}
