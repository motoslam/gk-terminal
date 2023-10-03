<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyFilter extends QueryFilter
{
    public function innerNumber(string $innerNumber)
    {
        $this->builder->where('inn', 'like', '%' . $innerNumber . '%');
    }
}
