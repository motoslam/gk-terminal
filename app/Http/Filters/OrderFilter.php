<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class OrderFilter extends QueryFilter
{
    public function type(string $type)
    {
        if (in_array($type, array_keys(Order::TYPES))) {
            $this->builder->where('type', $type);
        }
    }
}
