<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'company_name' => $this->vehicle->company->name ?: '',
            'numbercar' => $this->vehicle->numbercar ?: '',
            'numbertrailer' => $this->vehicle->numbertrailer ?: '',
            'locationcar' => $this->vehicle->locationcar ?: '',
            'link' => Storage::url($this->path),
            'created_at' => $this->created_at
        ];
    }
}
