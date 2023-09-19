<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
