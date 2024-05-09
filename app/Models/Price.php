<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        "model",
        "model_id",
        "currency",
        "value",
    ];

    protected $hidden = [
        "id",
        "model",
        "model_id",
        "created_at",
        "updated_at",
    ];

}
