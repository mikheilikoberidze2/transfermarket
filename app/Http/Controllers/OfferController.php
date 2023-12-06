<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequests\OffersStoreRequest;
use App\Http\Requests\OfferRequests\OffersUpdateRequest;
use App\Http\Resources\OfferResource;
use App\Models\Footballer;
use App\Models\Market;
use App\Models\Offer;
use App\Models\User;
use App\Services\OffersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{

    public function __construct(protected OffersService $offersService)
    {

    }
    public function index()
    {
        return $this->offersService->index(Auth::user());

    }

    public function store(OffersStoreRequest $request,Market $market): JsonResponse
    {
       return $this->offersService->store($request,$market,Auth::user());
    }
    public function show(Offer $offer)
    {
        return $this->offersService->show($offer,Auth::user());
    }

    public function accept(Offer $offer): JsonResponse
    {
        return $this->offersService->accept($offer);
    }

    public function update(OffersUpdateRequest $request,Offer $offer):JsonResponse
    {
        return $this->offersService->update($offer,Auth::user(),$request);
    }
    public function decline(Offer $offer):JsonResponse
    {
        return $this->offersService->decline($offer,Auth::user());
    }
    public function destroy(Offer $offer):JsonResponse
    {
        return $this->offersService->destroy($offer,Auth::user());
    }

}
