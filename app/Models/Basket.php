<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{


    protected $fillable = [
        "lens_id",
        "frame_id",
        "user_id",
        "currency",
        "total",
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
        'updated_at' => 'datetime:Y-m-d | H:i a',
    ];


    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function lens()
    {
        return $this->belongsTo(Lens::class);
    }
}
