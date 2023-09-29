<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Resources\VehicleResource;
use App\Http\Filters\VehicleFilter;

class VehicleController extends Controller
{
    public function index(VehicleFilter $filter)
    {
        $vehicles = VehicleResource::collection(
            Vehicle::all()
        );

        return $this->success('Success.', $vehicles);
    }
}
