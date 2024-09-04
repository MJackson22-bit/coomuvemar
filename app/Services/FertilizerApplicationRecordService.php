<?php

namespace App\Services;

use App\DTO\FertilizerApplicationRecord\FertilizerApplicationRecordDTO;
use App\Http\Requests\StoreFertilizerApplicationRecordRequest;
use App\Models\FertilizerApplicationRecord;
use Illuminate\Http\JsonResponse;
use Throwable;

class FertilizerApplicationRecordService
{
    public function index(int $pesticideApplicationRecordId): JsonResponse
    {
        try {
            $data = FertilizerApplicationRecord::where(
                column: 'registry_temporary_permanent_workers_id',
                operator: '=',
                value: $pesticideApplicationRecordId
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    public function store(StoreFertilizerApplicationRecordRequest $request, int $pesticideApplicationRecordId): JsonResponse
    {
        try {
            $dto = new FertilizerApplicationRecordDTO(
                nombre_fertilizante: $request->get('nombre_fertilizante'),
                lugar_aplicacion: $request->get('lugar_aplicacion'),
                tipo_insumo: $request->get('tipo_insumo'),
                procedencia_fertilizante: $request->get('procedencia_fertilizante'),
                dosis_planta: $request->get('dosis_planta'),
                dosis_manzana: $request->get('dosis_manzana'),
                veces_aplicado_anio: $request->get('veces_aplicado_anio'),
            );

            $data = FertilizerApplicationRecord::create([
                'nombre_fertilizante' => $dto->nombre_fertilizante,
                'lugar_aplicacion' => $dto->lugar_aplicacion,
                'tipo_insumo' => $dto->tipo_insumo,
                'procedencia_fertilizante' => $dto->procedencia_fertilizante,
                'dosis_planta' => $dto->dosis_planta,
                'dosis_manzana' => $dto->dosis_manzana,
                'veces_aplicado_anio' => $dto->veces_aplicado_anio,
                'registry_temporary_permanent_workers_id' => $pesticideApplicationRecordId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $data,
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
