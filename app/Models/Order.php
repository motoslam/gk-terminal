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
        'o' => 'Осмотр',
        'v' => 'Выгрузка',
        'a' => 'Выгрузка без ТС'
    ];

    protected $fillable = [
        'orderable_id',
        'orderable_type',
        'type',
        'path'
    ];

    public function orderable()
    {
        return $this->morphTo();
    }

}
