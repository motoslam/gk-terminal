<?php

namespace App\Http\Controllers;

use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterController extends Controller
{
    use RespondsWithHttpStatus;

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'role' => ['required', 'integer', Rule::in(array_keys(User::ROLES))]
        ]);

        $password = Str::random(8);

        $credentials['password'] = Hash::make($password);

        $user = User::create($credentials);

        auth()->login($user);

        return $this->success('success');
    }
}
