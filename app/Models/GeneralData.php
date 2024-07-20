<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralData extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_productor',
        'codigo',
        'numero_cedula',
        'nombre_finca',
        'altura_nivel_mar',
        'ciclo_productivo',
        'coordenadas_area_cacao',
        'departamento',
        'municipio',
        'comunidad',
        'area_total_finca',
        'area_cacao',
        'produccion',
        'desarrollo',
        'varidedades_cacao',
    ];

    public $timestamps = false;
}
