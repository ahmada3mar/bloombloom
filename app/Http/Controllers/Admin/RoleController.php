<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends AdminController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        $role->syncPermissions($data["permissions"]);
        return $role;
    }

    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        $role->syncPermissions($data["permissions"]);
        return $role;
    }
}
