<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'innerNumber' => $this->inn,
            'name' => $this->name,
            'employeeIds' => (array)$this->users->pluck('id')->all(),
            'isBlocked' => $this->blocked,
            'isChecked' => false
        ];
    }
}
