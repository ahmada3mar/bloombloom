<?php

namespace App\Models;

use App\Traits\HasCurrencyFilter;
use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    use HasCurrencyFilter;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
        'deleted_at' => 'datetime:Y-m-d | H:i a',
    ];


    protected $fillable = [
        "color",
        "description",
        "active",
        "stock",
    ];

    public function prices()
    {
        return $this->hasMany(Price::class, "model_id")
            ->where("model", static::class);
    }

    public function scopeWithFilters()
    {
        return $this->currency();
    }
}
