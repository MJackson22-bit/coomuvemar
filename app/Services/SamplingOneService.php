<?php

namespace App\Services;

use App\DTO\SamplingOne\SamplingOneDTO;
use App\Http\Requests\StoreSamplingOneRequest;
use App\Models\SamplingOne;
use Illuminate\Http\JsonResponse;
use Throwable;

class SamplingOneService
{
    public function index(int $pestMonitoringRecordDiseasesBeneficialInsectsId): JsonResponse
    {
        try {
            $data = SamplingOne::where(
                column: 'pest_monitoring_record_diseases_beneficial_insects_id',
                operator: '=',
                value: $pestMonitoringRecordDiseasesBeneficialInsectsId
            )->get();

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

    public function store(StoreSamplingOneRequest $request, int $pestMonitoringRecordDiseasesBeneficialInsectsId): JsonResponse
    {
        try {
            $dto = new SamplingOneDTO(
                numero_plantas_afectadas: $request->input('numero_plantas_afectadas'),
                numero_mazorcas_afectadas: $request->input('numero_mazorcas_afectadas'),
            );

            $data = SamplingOne::create([
                'numero_plantas_afectadas' => $dto->numero_plantas_afectadas,
                'numero_mazorcas_afectadas' => $dto->numero_mazorcas_afectadas,
                'pest_monitoring_record_diseases_beneficial_insects_id' => $pestMonitoringRecordDiseasesBeneficialInsectsId,
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
