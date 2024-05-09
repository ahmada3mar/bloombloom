<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           "name"=>"required|string",
           "email"=>"required|email|unique:users,email,except,id",
           "roles"=>"required|array|min:1",
           "roles.*"=>"required|string|exists:roles,name",
           "currency" => "required|string|in:USD,JOD,EUR,JPY,GBP"
        ];
    }
}
