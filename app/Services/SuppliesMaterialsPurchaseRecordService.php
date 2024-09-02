<?php

namespace App\Services;

use App\DTO\SuppliesMaterialsPurchaseRecord\SuppliesMaterialsPurchaseRecordDTO;
use App\Http\Requests\StoreSuppliesMaterialsPurchaseRecordRequest;
use App\Models\SuppliesMaterialsPurchaseRecord;
use Illuminate\Http\JsonResponse;
use Throwable;

class SuppliesMaterialsPurchaseRecordService
{
    public function index(int $generalDataId): JsonResponse
    {
        try {
            $suppliesMaterialsPurchaseRecord = SuppliesMaterialsPurchaseRecord::where(
                column: 'general_data_id',
                operator: '=',
                value: $generalDataId
            )->get()->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $suppliesMaterialsPurchaseRecord,
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    public function store(StoreSuppliesMaterialsPurchaseRecordRequest $request, int $generalDataId): JsonResponse
    {
        try {
            $suppliesMaterialsPurchaseRecordDTO = new SuppliesMaterialsPurchaseRecordDTO(
                nombre_producto: $request->get('nombre_producto'),
                cantidad: $request->get('cantidad'),
                unidad_medida: $request->get('unidad_medida'),
                fecha_compra: $request->get('fecha_compra'),
                costo_unitario: $request->get('costo_unitario'),
                costo_total: $request->get('costo_total'),
            );

            $suppliesMaterialsPurchaseRecord = SuppliesMaterialsPurchaseRecord::create([
                'nombre_producto' => $suppliesMaterialsPurchaseRecordDTO->nombre_producto,
                'cantidad' => $suppliesMaterialsPurchaseRecordDTO->cantidad,
                'unidad_medida' => $suppliesMaterialsPurchaseRecordDTO->unidad_medida,
                'fecha_compra' => $suppliesMaterialsPurchaseRecordDTO->fecha_compra,
                'costo_unitario' => $suppliesMaterialsPurchaseRecordDTO->costo_unitario,
                'costo_total' => $suppliesMaterialsPurchaseRecordDTO->costo_total,
                'general_data_id' => $generalDataId,
            ]);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $suppliesMaterialsPurchaseRecord,
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
