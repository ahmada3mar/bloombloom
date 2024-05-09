<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|unique:roles,name,except,id",
            "guard_name" => "required|in:api,web",
            "permissions" => "required|array",
            "permissions.*" => "nullable|string|exists:permissions,name",
        ];
    }
}
