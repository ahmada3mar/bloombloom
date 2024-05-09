<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Frame;
use App\Models\Lens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketObserver
{
    /**
     * Handle the Basket "created" event.
     *
     * @param  \App\Models\Basket  $basket
     * @return void
     */
    public function creating(Basket $basket)
    {
        $user = Auth::user();
        $frame = Frame::find($basket->frame_id);
        $lens = Lens::find($basket->lens_id);

        $basket->user_id = $user->id;
        $basket->currency = $user->currency;
        // store the sum of lens and frame
        $basket->total = $frame->prices->first()->value + $lens->prices->first()->value;

        // decrease stock by 1
        $frame->update(["stock" => DB::raw("stock-1")]);
        $lens->update(["stock" => DB::raw("stock-1")]);
    }
}
