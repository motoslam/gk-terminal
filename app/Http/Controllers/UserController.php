<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\RespondsWithHttpStatus;

class UserController extends Controller
{
    use RespondsWithHttpStatus;

    public function index()
    {
        return $this->success('ok');
    }

    public function show()
    {

    }

    public function store()
    {
    }

    public function destroy()
    {
    }
}
