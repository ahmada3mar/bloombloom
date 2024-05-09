<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LensRequest;
use App\Models\Lens;
use Illuminate\Http\Request;

class LensController extends AdminController
{
    public function search(&$query, $request)
    {

        if ($request->color != '') {
            $query->where('color', 'like', '%' . static::escape_like($request->color) . '%');
        }

        if ($request->prescription_type != '') {
            $query->where('prescription_type', 'like', '%' . static::escape_like($request->prescription_type) . '%');
        }

        if ($request->lens_type != '') {
            $query->where('	lens_type', 'like', '%' . static::escape_like($request->lens_type) . '%');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LensRequest $request)
    {
        $data = $request->validated();
        $lens = Lens::create($data);
        $lens->prices()->createMany($data["prices"]);
        return $lens;
    }


    /**
     * update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(LensRequest $request, Lens $lens)
    {
        $data = $request->validated();
        $lens->update($data);
        $lens->prices()->delete();
        $lens->prices()->createMany($data["prices"]);
        return $lens;
    }
}
