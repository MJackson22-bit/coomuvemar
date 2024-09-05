<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SketchLand extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'coordenadas',
        'general_data_id',
    ];
}
