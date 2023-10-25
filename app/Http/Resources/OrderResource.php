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

        if($this->orderable_type == 'App\Models\Company') {
            $name = $this->orderable->name;
        } else {
            $name = $this->orderable->company->name;
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
            'company_name' => $name ?: '',
            'numbercar' => $this->orderable->numbercar ?: '',
            'numbertrailer' => $this->orderable->numbertrailer ?: '',
            'locationcar' => $this->orderable->locationcar ?: '',
            'link' => Storage::url($this->path),
            'created_at' => $this->created_at
        ];
    }
}
