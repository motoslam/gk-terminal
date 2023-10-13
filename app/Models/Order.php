<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Order extends Model
{
    use HasFactory, Filterable;

    const TYPES = [
        'd' => 'Досмотр',
        'v' => 'Выгрузка'
    ];

    protected $fillable = [
        'vehicle_id',
        'type',
        'path'
    ];



    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
