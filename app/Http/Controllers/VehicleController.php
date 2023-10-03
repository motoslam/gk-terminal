<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Resources\VehicleResource;
use App\Http\Filters\VehicleFilter;
use App\Traits\RespondsWithHttpStatus;

class VehicleController extends Controller
{

    use RespondsWithHttpStatus;

    public function index(VehicleFilter $filter)
    {
        $vehicles = VehicleResource::collection(
            Vehicle::filter($filter)->get()
        );

        return $this->success('Success.', $vehicles);
    }
}
