<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class OrderFilter extends QueryFilter
{
    public function type($types)
    {
        $this->builder->whereIn('type', $this->paramToArray($types));
    }
}
