<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\RespondsWithHttpStatus;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\DocumentResource;
use App\Models\Company;
use App\Models\User;
use App\Http\Filters\CompanyFilter;

class CompanyController extends Controller
{
    use RespondsWithHttpStatus;

    public $responseData = [];

    public function index(CompanyFilter $filter)
    {
        return $this->success('Success.',
            CompanyResource::collection(
                Company::filter($filter)->get()
            )
        );
    }

    public function show(Company $company)
    {
        return $this->success('Success.', new CompanyResource($company));
    }

    public function attach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors(), 422);
        }

        $company = Company::find($request->company_id);
        $user = User::find($request->user_id);

        if ($company and $user) {
            $company->users()->attach($user);
            return $this->success('Success.');
        }

        return $this->failure('Not Found.', 404);
    }

    public function detach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors(), 422);
        }

        $company = Company::find($request->company_id);
        $user = User::find($request->user_id);

        if ($company and $user) {
            $company->users()->detach($user);
            return $this->success('Success.');
        }

        return $this->failure('Not Found.', 404);
    }

    public function block(Company $company)
    {
        $company->update(['blocked' => true]);

        return $this->success('Success.');
    }

    public function unblock(Company $company)
    {
        $company->update(['blocked' => false]);

        return $this->success('Success.');
    }

    public function destroy(Company $company)
    {
        $company->users()->detach();

        $company->delete();

        return $this->success('Success.');
    }

    public function documents(Company $company)
    {
        return $this->success('Success.',
            DocumentResource::collection(
                $company->documents
            )
        );
    }
}
