<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DocumentFilter extends QueryFilter
{
    public function for(string $for)
    {
        if ($for == 'company') {
            $this->builder->where('documentable_type', 'App\Models\Company');
        }
        if ($for == 'vehicle') {
            $this->builder->where('documentable_type', 'App\Models\Vehicle');
        }
    }
}
