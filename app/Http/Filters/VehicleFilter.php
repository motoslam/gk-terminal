<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class VehicleFilter extends QueryFilter
{
    public function company(int $company_id)
    {
        $this->builder->where('company_id', $company_id);
    }
}
