<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isManager()
    {
        return $this->role == 2;
    }

    public function isEmployee()
    {
        return $this->role == 3;
    }

    public function getRole()
    {
        return self::ROLES[$this->role];
    }

    public function getRoleTextAttribute($value)
    {
        return [1 => 'ADMIN', 2 => 'MANAGER', 3 => 'EMPLOYEE'][$this->role];
    }
}
