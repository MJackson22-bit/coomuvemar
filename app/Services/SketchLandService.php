<?php

namespace App\Services;

use App\Http\Requests\StoreSketchLandRequest;
use App\Models\SketchLand;
use Illuminate\Http\JsonResponse;
use Throwable;

class SketchLandService
{
    public function index(int $id): JsonResponse
    {
        try {
            $data = SketchLand::where(
                column: 'general_data_id',
                operator: '=',
                value: $id
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
    public function store(StoreSketchLandRequest $request, int $id): JsonResponse
    {
        try {
            $data = SketchLand::create([
                'coordenadas' => json_encode($request->get('coordenadas')),
                'general_data_id' => $id,
            ]);

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
}
