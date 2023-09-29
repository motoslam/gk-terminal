<?php

namespace App\Http\Controllers;

use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Models\User;

class RegisterController extends Controller
{
    use RespondsWithHttpStatus;

    public function register(Request $request)
    {
        if (auth()->user()->role == 1) {

            $credentials = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'role' => ['required', 'integer', Rule::in(array_keys(User::ROLES_FOR_CREATE))]
            ]);

            $password = Str::random(8);

            $credentials['password'] = Hash::make($password);

            $user = User::create($credentials);

            if ($user) {
                try {
                    Mail::to($user)->send(new RegisterMail([
                        'password' => $password,
                        'role' => $user->role
                    ]));
                } catch (\Exception $e) {
                    // do nothing or log this
                    // TODO: log this fail
                }
            }

            return $this->success('Success.');

        }

        return $this->failure('Access denied.', 403);
    }
}
