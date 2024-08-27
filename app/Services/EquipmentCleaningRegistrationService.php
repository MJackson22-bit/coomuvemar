<?php

namespace App\Services;

use App\DTO\EquipmentCleaningRegistration\EquipmentCleaningRegistrationDTO;
use App\Http\Requests\StoreEquipmentCleaningRegistrationRequest;
use App\Models\EquipmentCleaningRegistration;
use Illuminate\Http\JsonResponse;
use Throwable;

class EquipmentCleaningRegistrationService
{
    public function index(int $generalDataId): JsonResponse
    {
        try {
            $equipmentCleaningRegistration = EquipmentCleaningRegistration::where(
                column: 'general_data_id',
                operator: '=',
                value: $generalDataId
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $equipmentCleaningRegistration,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(StoreEquipmentCleaningRegistrationRequest $request, int $generalDataId): JsonResponse
    {
        try {
            $equipmentCleaningRegDTO = new EquipmentCleaningRegistrationDTO(
                actividad: $request->get('actividad'),
                equipo: $request->get('equipo'),
                fecha_uso: date('Y-m-d', strtotime($request->get('fecha_uso'))),
                productos_usados_limpiar_producto: $request->get('productos_usados_limpiar_producto'),
            );

            $equipmentCleaningRegistration = EquipmentCleaningRegistration::create([
                'actividad' => $equipmentCleaningRegDTO->actividad,
                'equipo' => $equipmentCleaningRegDTO->equipo,
                'fecha_uso' => $equipmentCleaningRegDTO->fecha_uso,
                'productos_usados_limpiar_producto' => json_encode($equipmentCleaningRegDTO->productos_usados_limpiar_producto),
                'general_data_id' => $generalDataId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $equipmentCleaningRegistration,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
