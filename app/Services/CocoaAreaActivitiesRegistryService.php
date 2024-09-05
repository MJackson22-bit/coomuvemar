<?php

namespace App\Services;

use App\DTO\CocoaAreaActivitiesRegistry\CocoaAreaActivitiesRegistryDTO;
use App\Http\Requests\StoreCocoaAreaActivitiesRegistryRequest;
use App\Models\CocoaAreaActivitiesRegistry;
use Illuminate\Http\JsonResponse;
use Throwable;

class CocoaAreaActivitiesRegistryService
{
    public function store(StoreCocoaAreaActivitiesRegistryRequest $request, int $id): JsonResponse
    {
        try {
            $dto = new CocoaAreaActivitiesRegistryDto(
                actividad: $request->get('actividad'),
                nombre_trabajador: $request->get('nombre_trabajador'),
                sexo: $request->get('sexo'),
                cedula: $request->get('cedula'),
                dias_trabajados: (int) $request->get('dias_trabajados'),
                pago_dia: $request->get('pago_dia'),
                pago_total: $request->get('pago_total'),
                pago_mensual: $request->get('pago_mensual'),
                fecha_pago: date('Y-m-d', strtotime($request->get('fecha_pago'))),
                firma: $request->get('firma'),
            );

            $data = CocoaAreaActivitiesRegistry::create([
                'actividad' => $dto->actividad,
                'nombre_trabajador' => $dto->nombre_trabajador,
                'sexo' => $dto->sexo,
                'cedula' => $dto->cedula,
                'dias_trabajados' => $dto->dias_trabajados,
                'pago_dia' => $dto->pago_dia,
                'pago_total' => $dto->pago_total,
                'pago_mensual' => $dto->pago_mensual,
                'fecha_pago' => $dto->fecha_pago,
                'firma' => $dto->firma,
                'registry_temporary_permanent_workers_id' => $id,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function index(int $id): JsonResponse
    {
        try {
            $data = CocoaAreaActivitiesRegistry::where(
                column: 'registry_temporary_permanent_workers_id',
                operator: '=',
                value: $id
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
