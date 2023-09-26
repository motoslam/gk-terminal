<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\RespondsWithHttpStatus;

class LicenseController extends Controller
{
    use RespondsWithHttpStatus;

    public function show()
    {
        $license = License::latest()->first();
        if ($license) {
            return $this->success('Success.', ['license' => $license->license]);
        }
        return $this->failure('Not found.', 404);
    }

    public function create(Request $request)
    {
        if ($request->user()->isAdmin() or $request->user()->isManager()) {

            $validator = Validator::make($request->all(), License::$rules);

            if ($validator->fails()) {
                return $this->failure($validator->errors(), 422);
            }

            $license = License::create([
                'user_id' => $request->user()->id,
                'license' => $request->license
            ]);

            if ($license) {
                return $this->success('Created.', ['license' => $license->license]);
            }

            return $this->failure('Error.');
        }

        return $this->failure('Access denied.', 403);
    }
}
