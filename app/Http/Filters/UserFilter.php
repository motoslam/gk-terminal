<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
{
    public function role(int $role)
    {
        $this->builder->where('role', $role);
    }
}
