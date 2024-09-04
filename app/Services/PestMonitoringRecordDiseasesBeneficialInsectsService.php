<?php

namespace App\Services;

use App\DTO\PestMonitoringRecordDiseasesBeneficialInsects\PestMonitoringRecordDiseasesBeneficialInsectsDTO;
use App\Http\Requests\StorePestMonitoringRecordDiseasesBeneficialInsectsRequest;
use App\Models\PestMonitoringRecordDiseasesBeneficialInsects;
use Illuminate\Http\JsonResponse;
use Throwable;

class PestMonitoringRecordDiseasesBeneficialInsectsService
{
    public function index(int $generalDataId): JsonResponse
    {
        try {
            $data = PestMonitoringRecordDiseasesBeneficialInsects::where(
                column: 'general_data_id',
                operator: '=',
                value: $generalDataId
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
    public function store(StorePestMonitoringRecordDiseasesBeneficialInsectsRequest $request, int $generalDataId): JsonResponse
    {
        try {
            $dto = new PestMonitoringRecordDiseasesBeneficialInsectsDTO(
                fecha_monitoreo: date('Y-m-d', strtotime($request->get('fecha_monitoreo'))),
                nombre_plaga_enfermedad: $request->get('nombre_plaga_enfermedad'),
            );
            $storage = PestMonitoringRecordDiseasesBeneficialInsects::create([
                'general_data_id' => $generalDataId,
                'fecha_monitoreo' => $dto->fecha_monitoreo,
                'nombre_plaga_enfermedad' => $dto->nombre_plaga_enfermedad,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $storage,
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
