<?php

namespace App\Services;

use App\DTO\GeneralData\GeneralDataDTO;
use App\Models\GeneralData;

class GeneralDataService
{
    public function store(GeneralDataDTO $generalDataDTO, int $userId): GeneralData
    {
        return GeneralData::create([
            'nombre_productor' => $generalDataDTO->nombre_productor,
            'codigo' => $generalDataDTO->codigo,
            'numero_cedula' => $generalDataDTO->numero_cedula,
            'nombre_finca' => $generalDataDTO->nombre_finca,
            'altura_nivel_mar' => $generalDataDTO->altura_nivel_mar,
            'ciclo_productivo' => $generalDataDTO->ciclo_productivo,
            'coordenadas_area_cacao' => $generalDataDTO->coordenadas_area_cacao,
            'departamento' => $generalDataDTO->departamento,
            'municipio' => $generalDataDTO->municipio,
            'comunidad' => $generalDataDTO->comunidad,
            'area_total_finca' => $generalDataDTO->area_total_finca,
            'area_cacao' => $generalDataDTO->area_cacao,
            'produccion' => $generalDataDTO->produccion,
            'desarrollo' => $generalDataDTO->desarrollo,
            'variedades_cacao' => $generalDataDTO->variedades_cacao,
            'user_id' => $userId
        ]);
    }
}
