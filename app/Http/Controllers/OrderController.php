<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\RespondsWithHttpStatus;
use App\Http\Filters\OrderFilter;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(OrderFilter $filter)
    {
        return $this->success('Success.',
            OrderResource::collection(
                Order::filter($filter)->get()
            )
        );
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'type' => ['required', Rule::in(array_keys(Order::TYPES))],
            'file' => ['required', 'file', 'mimes:pdf'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors(), 422);
        }

        if ($request->post('type') == 'a') {

            $company = Company::findOrFail(
                $request->post('id')
            );

            $path = $request->file('file')->store(
                'orders/a/' . $company->id,
                'public'
            );

            $company->orders()->create([
                'type' => $request->type,
                'path' => $path
            ]);

        } else {

            $vehicle = Vehicle::findOrFail(
                $request->post('id')
            );

            $path = $request->file('file')->store(
                'orders/' . $vehicle->id,
                'public'
            );

            $vehicle->orders()->create([
                'type' => $request->type,
                'path' => $path
            ]);

        }

        return $this->success('Success.');

    }


}
