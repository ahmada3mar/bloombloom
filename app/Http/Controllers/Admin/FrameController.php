<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FrameRequest;
use App\Models\Frame;


class FrameController extends AdminController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrameRequest $request)
    {
        $data = $request->validated();
        $frame = Frame::create($data);
        $frame->prices()->createMany($data["prices"]);
        return $frame;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(FrameRequest $request, Frame $frame)
    {
        $data = $request->validated();
        $frame->update($data);
        $frame->prices()->delete();
        $frame->prices()->createMany($data["prices"]);
        return $frame;
    }
}
