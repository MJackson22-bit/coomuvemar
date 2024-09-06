<?php

namespace App\Services;

use App\Http\Requests\StoreSketchLandRequest;
use App\Http\Requests\UpdateSketchLandRequest;
use App\Models\GeneralData;
use App\Models\SketchLand;
use Illuminate\Http\JsonResponse;
use Throwable;

class SketchLandService
{
    public function delete(int $id): JsonResponse
    {
        try {
            $result = SketchLand::query()
                ->findOrFail($id)->delete();

            return response()->json([
                'status' => $result,
                'statusCode' => 200,
                'message' => 'Registro eliminado exitosamente',
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updated(UpdateSketchLandRequest $request, int $id): JsonResponse
    {
        try {
            $result = SketchLand::query()
                ->findOrFail($id)->updateOrFail([
                    'coordenadas' => json_encode($request->get('coordenadas')),
                ]);

            return response()->json([
                'status' => $result,
                'statusCode' => 200,
                'message' => 'Registro actualizado correctamente',
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
            $data = SketchLand::query()
                ->where('general_data_id', $id)
                ->get()
                ->toArray();

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
            GeneralData::query()->findOrFail($id);
            $data = SketchLand::query()
                ->create([
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
