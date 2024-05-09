<?php

namespace App\Http\Requests;

use App\Models\Lens;
use Illuminate\Foundation\Http\FormRequest;

class LensRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $prices = array_map(function ($price) {
            $price["model"] = Lens::class;
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
            "color" => "required|string|min:3",
            "description" => "required|string|min:3",
            "prescription_type" => "required|string|in:fashion,single_vision,varifocal",
            "lens_type" => "required|string|in:classic,blue_light,transition",
            "stock" => "required|integer|min:0",
            "prices" => "required|array|min:1",
            "prices.*.currency" => "required|string|in:USD,JOD,EUR,JPY,GBP",
            "prices.*.value" => "required|numeric|min:0",
        ];
    }
}
