<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Document extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'path',
        'documentable_id',
        'documentable_type'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

}
