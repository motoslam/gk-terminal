<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'docnum' => $this->docnum,
            'numbercar' => $this->numbercar,
            'numbertrailer' => $this->numbertrailer,
            'arrivaldate' => $this->arrivaldate,
            'notesguard' => $this->notesguard,
            'closingdatedelivery' => $this->closingdatedelivery,
            'locationcar' => $this->locationcar,
            'numberdt' => $this->numberdt,
            'statusdt' => $this->statusdt,
            'inningsdt' => $this->inningsdt,
            'releasedt' => $this->releasedt,
            'specialistinformation' => $this->specialistinformation,
            'fitovetcontrol' => $this->fitovetcontrol,
            'dateappointmentinspection' => $this->dateappointmentinspection,
            'enddateinspectionfact' => $this->enddateinspectionfact,
            'datedeparture' => $this->datedeparture,
            'target' => $this->target,
        ];
    }
}
