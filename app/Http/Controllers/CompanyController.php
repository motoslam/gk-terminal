<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\RespondsWithHttpStatus;
use App\Models\Company;

class CompanyController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(Request $request)
    {
        $companies = Company::paginate(Company::PAGE_SIZE);

        return $this->success('success', $companies);
    }
}
