<?php

namespace App\Services;

use App\DTO\IntegratedPestManagementActivities\IntegratedPestManagementActivitiesDTO;
use App\Http\Requests\StoreIntegratedPestManagementActivitiesRequest;
use App\Models\IntegratedPestManagementActivities;
use Illuminate\Http\JsonResponse;
use Throwable;

class IntegratedPestManagementActivitiesService
{
    public function index(int $generalDataId): JsonResponse
    {
        try {
            $integratedPestManagementActivities = IntegratedPestManagementActivities::where(
                column: 'general_data_id',
                operator: '=',
                value: $generalDataId
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $integratedPestManagementActivities,
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    public function store(StoreIntegratedPestManagementActivitiesRequest $request, int $generalDataId): JsonResponse
    {
        try {
            $integratePestManagementActivitiesDTO = new IntegratedPestManagementActivitiesDTO(
                nombre_apellido_aplicador: $request->get('nombre_apellido_aplicador'),
                plaga_enfermedad: $request->get('plaga_enfermedad'),
                nivel_danio: $request->get('nivel_danio'),
                metodo_aplicado: $request->get('metodo_aplicado'),
                hora_aplicacion: $request->get('hora_aplicacion'),
                duracion_dias_metodo_aplicado: $request->get('duracion_dias_metodo_aplicado'),
                resultado_aplicacion: $request->get('resultado_aplicacion'),
            );

            $integratePestManagementActivities = IntegratedPestManagementActivities::create([
                'nombre_apellido_aplicador' => $integratePestManagementActivitiesDTO->nombre_apellido_aplicador,
                'plaga_enfermedad' => $integratePestManagementActivitiesDTO->plaga_enfermedad,
                'nivel_danio' => $integratePestManagementActivitiesDTO->nivel_danio,
                'metodo_aplicado' => $integratePestManagementActivitiesDTO->metodo_aplicado,
                'hora_aplicacion' => $integratePestManagementActivitiesDTO->hora_aplicacion,
                'duracion_dias_metodo_aplicado' => $integratePestManagementActivitiesDTO->duracion_dias_metodo_aplicado,
                'resultado_aplicacion' => $integratePestManagementActivitiesDTO->resultado_aplicacion,
                'general_data_id' => $generalDataId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $integratePestManagementActivities,
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