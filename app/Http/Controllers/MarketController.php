<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketRequests\MarketStoreRequest;
use App\Http\Requests\MarketRequests\MarketUpdateRequest;
use App\Http\Resources\MarketResource;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Market::class,'market');
    }

    public function index(){
        $market = Market::all();
        return MarketResource::Collection($market);
    }
    public function store(MarketStoreRequest $request)
    {
        $validatedData=$request->validated();
        $president = Auth::user();
        $president->market()->create($validatedData);
        return response()->json(['message' => 'Market listing created'], 201);
    }
    public function show(Market $market)
    {
        return new MarketResource($market);
    }
    public function update(MarketUpdateRequest $request,Market $market)
    {
        $market->update($request->validated());
        return response()->json(['message'=>'Market listing Updated', 201]);
    }
    public function destroy(Market $market)
    {
        $market->delete();
        return response()->json(['message'=>'Market listing Deleted'],201);
    }
}
