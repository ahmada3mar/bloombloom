<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $permission = Permission::create($data);
        return $permission;
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $permission->update($data);
        return $permission;
    }
}
