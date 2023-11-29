<?php

namespace App\Http\Controllers;

use App\Http\Requests\NationalRequests\NationalStoreRequest;
use App\Http\Requests\NationalRequests\NationalUpdateRequest;
use App\Http\Resources\NationalResource;
use App\Models\National;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(National::class,'national');
    }
    public function index()
    {
       $data =  National::all();
        return NationalResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NationalStoreRequest $request)
    {
        $validatedData = $request->validated();
        $president = Auth::user();
        $president->national()->create($validatedData);
        return response()->json(['message' => 'National created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(National $national)
    {
        return new NationalResource($national);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NationalUpdateRequest $request, National $national)
    {
        $validatedData = $request->validated();
        $national->update($validatedData);
        return response()->json(['message'=>'National Updated'],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(National $national)
    {
        $national->delete();
        return response()->json(['message' => 'National deleted'], 201);
    }
}
