<?php

namespace App\Services;

use App\DTO\RenewalRegistration\RenewalRegistrationDTO;
use App\Http\Requests\StoreRenewalRegistrationRequest;
use App\Models\RenewalRegistration;
use Illuminate\Http\JsonResponse;
use Throwable;

class RenewalRegistrationService
{
    public function index(int $generalDataId): JsonResponse
    {
        try {
            $renewalRegistration = RenewalRegistration::where(
                column: 'general_data_id',
                operator: '=',
                value: $generalDataId
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $renewalRegistration,
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    public function store(StoreRenewalRegistrationRequest $request, int $generalDataId): JsonResponse
    {
        try {
            $renewalRegistrationDTO = new RenewalRegistrationDTO(
                fecha_injertacion: $request->get('fecha_injertacion'),
                numero_plantas_injertada_por_mz: $request->get('numero_plantas_injertada_por_mz'),
                nombre_clones_injertados: $request->get('nombre_clones_injertados'),
                nombre_proveedor: $request->get('nombre_proveedor'),
            );

            $renewalRegistration = RenewalRegistration::create([
                'fecha_injertacion' => $renewalRegistrationDTO->fecha_injertacion,
                'numero_plantas_injertada_por_mz' => $renewalRegistrationDTO->numero_plantas_injertada_por_mz,
                'nombre_clones_injertados' => json_encode($renewalRegistrationDTO->nombre_clones_injertados),
                'nombre_proveedor' => $renewalRegistrationDTO->nombre_proveedor,
                'general_data_id' => $generalDataId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $renewalRegistration,
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
