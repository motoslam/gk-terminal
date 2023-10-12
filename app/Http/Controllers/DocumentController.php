<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Company;
use App\Models\Document;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Filters\DocumentFilter;

class DocumentController extends Controller
{

    use RespondsWithHttpStatus;

    public function index(DocumentFilter $filter)
    {
        return $this->success('Success.',
            DocumentResource::collection(
                Document::filter($filter)->get()
            )
        );
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'for' => ['required', Rule::in(['company', 'vehicle'])],
            'id' => ['required', 'integer'],
            'file' => ['required', 'file'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors(), 422);
        }

        if ($request->post('for') == 'company') {

            $company = Company::findOrFail($request->post('id'));

            $path = $request->file('file')->store(
                'documents/company/' . $company->id . '/' . date('dmy')
            );

            $company->documents()->create([
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => $path
            ]);

            return $this->success('Success.');

        } elseif ($request->post('for') == 'vehicle') {

            $vehicle = Vehicle::where('docnum', $request->post('id'))->first();

            if (!$vehicle) {
                return $this->failure('Not found.', 404);
            }

            $path = $request->file('file')->store(
                'documents/vehicle/' . $vehicle->id . '/' . date('dmy')
            );

            $vehicle->documents()->create([
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => $path
            ]);

            return $this->success('Success.');

        } else {
            return $this->failure('Failed.', 400);
        }

    }
}
