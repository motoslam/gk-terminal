<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'code',
        'name',
        'inn',
        'kpp',
        'blocked'
    ];

    protected $casts = [
        'blocked' => 'boolean'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

}
