<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends AdminController
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $user->syncRoles($data["roles"]);
        return $user;
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if (array_key_exists("password", $data)) {
            $data["password"] = \bcrypt($data["password"]);
        }

        $user->update($data);
        $user->syncRoles($data["roles"]);
        return $user;
    }
}
