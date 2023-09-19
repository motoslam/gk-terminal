<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'company_id',
        'docnum',
        'numbercar',
        'numbertrailer',
        'arrivaldate',
        'notesguard',
        'closingdatedelivery',
        'locationcar',
        'numberdt',
        'inningsdt',
        'releasedt',
        'specialistinformation',
        'fitovetcontrol',
        'dateappointmentinspection',
        'datedeparture',
        'target'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
