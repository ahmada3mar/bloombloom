<?php

namespace App\Traits;

use App\Models\Scopes\CurrencyScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasCurrencyFilter
{

    public function scopeCurrency(Builder $builder): void
    {
        $user = Auth::user();
        $builder->with(["Prices" => fn ($p) => $p->whereCurrency($user->currency)])
            ->whereHas("Prices");
    }
}
