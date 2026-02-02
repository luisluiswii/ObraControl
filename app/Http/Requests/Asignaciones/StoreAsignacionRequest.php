<?php

namespace App\Http\Requests\Asignaciones;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsignacionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'obra_id' => 'required|exists:obras,id',
            'trabajador_id' => 'required|exists:trabajadores,id',
            'fecha_asignacion' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_asignacion',
        ];
    }
}
