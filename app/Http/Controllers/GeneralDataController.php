<?php

namespace App\Http\Controllers;

use App\DTO\GeneralData\GeneralDataDTO;
use App\Http\Requests\StoreGeneralDataRequest;
use App\Http\Requests\UpdateGeneralDataRequest;
use App\Models\GeneralData;
use App\Services\GeneralDataService;
use Illuminate\Http\JsonResponse;
use Throwable;

class GeneralDataController extends Controller
{
    private GeneralDataService $generalDataService;

    public function __construct(GeneralDataService $generalDataService)
    {
        $this->generalDataService = $generalDataService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneralDataRequest $request, int $userId): JsonResponse
    {
        try {
            $generalDataDTO = new GeneralDataDTO(
                nombre_productor: $request->get('nombre_productor'),
                codigo: $request->get('codigo'),
                numero_cedula: $request->get('numero_cedula'),
                nombre_finca: $request->get('nombre_finca'),
                altura_nivel_mar: $request->get('altura_nivel_mar'),
                ciclo_productivo: $request->get('ciclo_productivo'),
                coordenadas_area_cacao: $request->get('coordenadas_area_cacao'),
                departamento: $request->get('departamento'),
                municipio: $request->get('municipio'),
                comunidad: $request->get('comunidad'),
                area_total_finca: $request->get('area_total_finca'),
                area_cacao: $request->get('area_cacao'),
                produccion: $request->get('produccion'),
                desarrollo: $request->get('desarrollo'),
                variedades_cacao: $request->get('variedades_cacao'),
            );

            $generalData = $this->generalDataService->store($generalDataDTO, $userId);

            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'data' => $generalData,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralData $generalData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralData $generalData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneralDataRequest $request, GeneralData $generalData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralData $generalData)
    {
        //
    }
}
