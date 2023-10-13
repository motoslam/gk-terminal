<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\RespondsWithHttpStatus;
use App\Http\Filters\OrderFilter;

class OrderController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(OrderFilter $filter)
    {
        return $this->success('Success.');
    }

    public function upload(Request $request)
    {
        return $this->success('debug.', $request->all());

        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'type' => ['required', Rule::in(array_keys(Order::TYPES))],
            'file' => ['required', 'file', 'mimes:pdf'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors(), 422);
        }

        $vehicle = Vehicle::findOrFail(
            (int)$request->post('id')
        );

        $path = $request->file('file')->store(
            'orders/' . $vehicle->id
        );

        $vehicle->orders()->create([
            'type' => $request->type,
            'path' => $path
        ]);

        return $this->success('Success.');

    }
}
