<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre_productor' => ['required', 'string'],
            'codigo' => ['required', 'string'],
            'numero_cedula' => ['required', 'string'],
            'nombre_finca' => ['required', 'string'],
            'altura_nivel_mar' => ['required', 'numeric'],
            'ciclo_productivo' => ['required', 'string'],
            'coordenadas_area_cacao' => ['required', 'string'],
            'departamento' => ['required', 'string'],
            'municipio' => ['required', 'string'],
            'comunidad' => ['required', 'string'],
            'area_total_finca' => ['required', 'numeric'],
            'area_cacao' => ['required', 'numeric'],
            'produccion' => ['required', 'numeric'],
            'desarrollo' => ['required', 'numeric'],
            'variedades_cacao' => ['required', 'string'],
        ];
    }
}
