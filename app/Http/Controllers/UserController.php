<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\RespondsWithHttpStatus;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Filters\UserFilter;

class UserController extends Controller
{
    use RespondsWithHttpStatus;

    public function index(UserFilter $filter)
    {
        $users = UserResource::collection(
            User::notAdmin()
                ->filter($filter)
                ->get()
        );

        return $this->success('Success.', $users);
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

    public function destroy(User $user)
    {
        if(auth()->user()->isAdmin()) {

            $user->companies()->detach();

            $user->delete();

            return $this->success('Success.');

        }

        return $this->failure('Access denied.', 403);
    }
}
