<?php

namespace App\Http\Requests;

use App\Models\Frame;
use Illuminate\Foundation\Http\FormRequest;

class FrameRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $prices = array_map(function ($price) {
            $price["model"] = Frame::class;
            return $price;
        }, $this->prices ?? []);

        $this->merge(["prices" => $prices]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|min:3",
            "description" => "required|string|min:3",
            "active" => "required|boolean",
            "stock" => "required|integer|min:0",
            "prices" => "required|array|min:1",
            "prices.*.currency" => "required|string|in:USD,JOD,EUR,JPY,GBP",
            "prices.*.value" => "required|numeric|min:0",
            "prices.*.model" => "nullable",
        ];
    }
}
