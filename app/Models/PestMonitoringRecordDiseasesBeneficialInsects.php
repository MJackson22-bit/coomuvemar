<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PestMonitoringRecordDiseasesBeneficialInsects extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'fecha_monitoreo',
        'nombre_plaga_enfermedad',
        'general_data_id',
    ];
}
