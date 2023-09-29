<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Filterable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    const ROLES = [
        1 => "Администратор",
        2 => "Менеджер",
        3 => "Сотрудник",
    ];

    # Список пользователей, которых можно создавать через интерфейс
    const ROLES_FOR_CREATE = [
        2 => "Менеджер",
        3 => "Сотрудник",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'blocked',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['role_text'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked' => 'boolean',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function isAdmin(): bool
    {
        return $this->role == 1;
    }

    public function isManager(): bool
    {
        return $this->role == 2;
    }

    public function isEmployee(): bool
    {
        return $this->role == 3;
    }

    public function scopeNotAdmin($query)
    {
        $query->where('role', '<>', 1);
    }

    public function getRole(): string
    {
        return self::ROLES[$this->role];
    }

    public function getRoleTextAttribute($value): string
    {
        return [1 => 'ADMIN', 2 => 'MANAGER', 3 => 'EMPLOYEE'][$this->role];
    }
}
