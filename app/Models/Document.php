<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use Carbon\Carbon;

class Document extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'path',
        'documentable_id',
        'documentable_type'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone'))
            ->toDateTimeString();
    }

    public function documentable()
    {
        return $this->morphTo();
    }

}
