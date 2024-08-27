<?php

namespace App\Services;

use App\DTO\Plantation\PlantationDTO;
use App\Http\Requests\StorePlantationRequest;
use App\Models\Plantation;
use Illuminate\Http\JsonResponse;
use Throwable;

class PlantationService
{
    public function store(StorePlantationRequest $plantationRequest, int $generalDataId): JsonResponse
    {
        try {
            $plantationDTO = new PlantationDTO(
                tipo_poda: $plantationRequest->get('tipo_poda'),
                numero_plantas_podadas: $plantationRequest->get('numero_plantas_podadas'),
                fecha_podada: date('Y-m-d', strtotime($plantationRequest->get('fecha_podada'))),
                mz_area_podada: $plantationRequest->get('mz_area_podada'),
                tipo_plantacion: $plantationRequest->get('tipo_plantacion')
            );

            $plantation = Plantation::create([
                'tipo_poda' => $plantationDTO->tipo_poda,
                'numero_plantas_podadas' => $plantationDTO->numero_plantas_podadas,
                'fecha_podada' => $plantationDTO->fecha_podada,
                'mz_area_podada' => $plantationDTO->mz_area_podada,
                'tipo_plantacion' => $plantationDTO->tipo_plantacion,
                'general_data_id' => $generalDataId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $plantation,
            ], 201);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}
