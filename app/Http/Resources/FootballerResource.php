<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FootballerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'lastname'=> $this->lastname,
            'club_id' => $this->club_id,
            'club_name'=> $this->club->name,
            'national_id'=> $this->national_id,
            'national_name' => $this->national->name,
        ];
    }
}
