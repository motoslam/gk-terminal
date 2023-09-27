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

    const PAGE_SIZE = 15;

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
