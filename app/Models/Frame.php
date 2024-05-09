<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use App\Traits\HasActiveFilter;
use App\Traits\HasCurrencyFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasCurrencyFilter , HasActiveFilter;


    protected $fillable = [
        "name",
        "description",
        "active",
        "stock",
    ];

    protected $casts = [
        'active' => "boolean",
        'created_at' => 'datetime:Y-m-d | H:i a',
        'deleted_at' => 'datetime:Y-m-d | H:i a',
    ];



    public function prices()
    {
        return $this->hasMany(Price::class, "model_id")
            ->where("model", static::class);
    }

    public function scopeWithFilters()
    {
        return $this->active()->currency();
    }
}
