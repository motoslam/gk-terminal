<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\RespondsWithHttpStatus;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    use RespondsWithHttpStatus;

    public $responseData = [];

    public function index(Request $request)
    {
        $query = User::where('role', '<>', 1);

        if ($request->filled('role')) {
            $query->where('role', $request->get('role'));
        }

        $users = $query->get();

        return $this->success('Success.', UserResource::collection($users));
    }

    public function block(User $user)
    {
        $user->update(['blocked' => true]);

        return $this->success('Success.');
    }

    public function unblock(User $user)
    {
        $user->update(['blocked' => false]);

        return $this->success('Success.');
    }

    public function show(User $user)
    {
        return $this->success('Success.', new UserResource($user));
    }
    public function store()
    {
    }

    public function destroy()
    {
    }
}
