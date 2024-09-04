<?php

namespace App\Services;

use App\DTO\PesticideApplicationRecord\PesticideApplicationRecordDTO;
use App\Http\Requests\StorePesticideApplicationRecordRequest;
use App\Models\PesticideApplicationRecord;
use Illuminate\Http\JsonResponse;
use Throwable;

class PesticideApplicationRecordService
{
    public function index(int $pesticideApplicationRecordId): JsonResponse
    {
        try {
            $data = PesticideApplicationRecord::where(
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
    public function store(StorePesticideApplicationRecordRequest $request, int $pesticideApplicationRecordId): JsonResponse
    {
        try {
            $dto = new PesticideApplicationRecordDTO(
                nombres_apellidos_aplicadores: $request->input('nombres_apellidos_aplicadores'),
                plaga_enfermedad: $request->input('plaga_enfermedad'),
                nombre_producto: $request->input('nombre_producto'),
                fecha_aplicacion: $request->input('fecha_aplicacion'),
                hora_aplicacion: $request->input('hora_aplicacion'),
                onzas_dosis_bombadas: $request->input('onzas_dosis_bombadas'),
                mz_area_producto_aplicado: $request->input('mz_area_producto_aplicado'),
                lugar_cultivo_producto_aplicado: $request->input('lugar_cultivo_producto_aplicado'),
                litros_total_volumen_aplicado: $request->input('litros_total_volumen_aplicado'),
            );

            $data = PesticideApplicationRecord::create([
                'nombres_apellidos_aplicadores' => $dto->nombres_apellidos_aplicadores,
                'plaga_enfermedad' => $dto->plaga_enfermedad,
                'nombre_producto' => $dto->nombre_producto,
                'fecha_aplicacion' => $dto->fecha_aplicacion,
                'hora_aplicacion' => $dto->hora_aplicacion,
                'onzas_dosis_bombadas' => $dto->onzas_dosis_bombadas,
                'mz_area_producto_aplicado' => $dto->mz_area_producto_aplicado,
                'lugar_cultivo_producto_aplicado' => $dto->lugar_cultivo_producto_aplicado,
                'litros_total_volumen_aplicado' => $dto->litros_total_volumen_aplicado,
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
