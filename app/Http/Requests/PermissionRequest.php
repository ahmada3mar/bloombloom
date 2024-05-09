<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|unique:permissions,name,except,id",
            "group" => "required|string",
            "guard_name" => "required|in:api,web",
            "description" => "required|string",
        ];
    }
}
