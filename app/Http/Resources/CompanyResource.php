<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $employeeIds = [];
        $users = $this->users()->where('role', 3)->get();
        foreach ($users as $user) {
            $employeeIds[] = $user->id;
        }

        return [
            'id' => $this->id,
            'innerNumber' => $this->inn,
            'name' => $this->name,
            'employeeIds' => $employeeIds,
            'isBlocked' => $this->blocked,
            'isChecked' => false
        ];
    }
}
