<?php

namespace App\Http\Requests;

use App\Models\Frame;
use App\Models\Lens;
use App\Rules\InStock;
use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "frame_id" => ["required", new InStock(Frame::class, ["active" => true])],
            "lens_id" => ["required", new InStock(Lens::class)],
        ];
    }
}
