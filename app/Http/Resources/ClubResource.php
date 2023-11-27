<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'manager_id' => $this->manager_id,
            'manager_name' => $this->manager->name,
            'president_id' => $this->president_id,
            'president_name' => $this->president->name,

        ];
    }
}
