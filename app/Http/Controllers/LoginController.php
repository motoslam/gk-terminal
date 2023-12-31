<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\RespondsWithHttpStatus;

class LoginController extends Controller
{

    use RespondsWithHttpStatus;

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $request->user()->tokens()->delete();

            $token = $request->user()->createToken('auth');

            return $this->success('success', ['token' => $token->plainTextToken]);
            
        }

        return $this->failure(
            'The provided credentials do not match our records.',
            401
        );

    }
}
