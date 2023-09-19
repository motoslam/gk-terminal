<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\RespondsWithHttpStatus;

class ImportController extends Controller
{
    use RespondsWithHttpStatus;

    private $error;

    public function make(Request $request)
    {
        $data = $request->json()->all();

        if (empty($data)) {
            $this->failure('Incorrect data');
        }

        return $this->success('Import completed');

    }

}
