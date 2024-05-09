<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveFilter
{

    public function scopeActive(Builder $query): void
    {
        $query->whereActive(true);
    }

}
