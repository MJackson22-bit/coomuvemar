<?php

namespace App\DTO\PestMonitoringRecordDiseasesBeneficialInsects;

class PestMonitoringRecordDiseasesBeneficialInsectsDTO
{
    public string $fecha_monitoreo;

    public string $nombre_plaga_enfermedad;

    public function __construct(
        string $fecha_monitoreo,
        string $nombre_plaga_enfermedad
    ) {
        $this->nombre_plaga_enfermedad = $nombre_plaga_enfermedad;
        $this->fecha_monitoreo = $fecha_monitoreo;
    }
}
