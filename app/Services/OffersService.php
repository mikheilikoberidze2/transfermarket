<?php

namespace App\Services;

use App\Http\Requests\OfferRequests\OffersUpdateRequest;
use App\Http\Resources\OfferResource;
use App\Models\Footballer;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OffersService
{
    public function index(User $user)
    {
        if($user->sentOffers)
        {
            $offers =  $user->sentOffers->all();
            return OfferResource::Collection($offers);
        }
        else if($user->receivedOffers)
        {
            $offers =  $user->receivedOffers->all();
            return OfferResource::Collection($offers);
        }
        else
        {
            return response()->json(['message' => 'offer not found'], 400);
        }
    }
    public function show(Offer $offer,User $user)
    {
        if($offer->receiver->id===$user->id || $offer->sender->id===$user->id)
        {
            return new OfferResource($offer);
        }
        else
        {
            return response()->json(['message' => 'offer not found'], 400);
        }
    }
    public function store($request, $market,User $user): JsonResponse
    {
        $validatedData = $request->validated();
        $receiver = User::find($market->user_id);
        $validatedData['receiver_id'] = $receiver->id;
        $validatedData['market_id'] = $market->id;
        $footballer = Footballer::find($market->footballer_id);
        if ($this->getRoleRelation($user) && $this->getRoleRelation($receiver) &&
            $footballer->club_id === $this->getRoleRelation($receiver)->id &&$footballer->club_id !== $this->getRoleRelation($user)->id) {
            $newOffer = $user->sentOffers()->create($validatedData);
            return $newOffer->exists()
                ? response()->json(['message' => 'Offer created'], 201)
                : response()->json(['message' => 'Offer creation failed'], 500);
        } else {
            return response()->json(['message' => 'Cannot create offer: footballer already owned or user has no club'], 400);
        }
    }

    //this function finds receiver user and their club also sender user and their club determines whether user is manager or
    //president, updates club budgets and gives footballer new club id also removes the offer.
    public function accept(Offer $offer): JsonResponse
    {
        $receiver = Auth::user();
        $receivedOffer = $receiver->receivedOffers->find($offer->id);

        if ($receivedOffer) {
            $sender = User::find($receivedOffer->sender_id);
            $footballer = Footballer::find($offer->market->footballer_id);

            $roleRelationReceiver = $this->getRoleRelation($receiver);
            $roleRelationSender = $this->getRoleRelation($sender);

            if ($roleRelationReceiver && $roleRelationSender) {
                $roleRelationReceiver->update(['budget' => $roleRelationReceiver->budget + $receivedOffer->price]);
                $roleRelationSender->update(['budget' => $roleRelationSender->budget - $receivedOffer->price]);

                $footballer->update(['club_id' => $roleRelationSender->id]);

                $receivedOffer->delete();
                $receivedOffer->market->delete();
                return response()->json(['message' => 'Offer accepted'], 201);
            }
        }
        return response()->json(['message' => 'No offer found'], 404);
    }

    public function update(Offer $offer,User $user,OffersUpdateRequest $request):JsonResponse
    {
        $validatedData = $request->validated();
        if($offer->receiver->id===$user->id){
            $offer->update($validatedData);
            return response()->json(['message' => 'Offer updated'], 201);
        }
        else
        {
            return response()->json(['message' => 'Could not update offer'], 201);
        }
    }

    public function decline(Offer $offer,User $user):JsonResponse
    {
        if($offer->receiver->id===$user->id){
            $offer->delete();
            return response()->json(['message' => 'Offer declined'], 201);
        }
        else
        {
            return response()->json(['message' => 'Could not decline offer'], 201);
        }
    }
    public function destroy(Offer $offer,User $user):JsonResponse
    {
        if($offer->sender->id===$user->id){
            $offer->delete();
            return response()->json(['message' => 'Offer deleted'], 201);
        }
        else
        {
            return response()->json(['message' => 'Could not delete offer'], 201);
        }
    }
    private function getRoleRelation($user)
    {
        if ($user->hasRole('president')) {
            return $user->presidentClub;
        } else if ($user->hasRole('manager')) {
            return $user->managerClub;
        }
    }

}


