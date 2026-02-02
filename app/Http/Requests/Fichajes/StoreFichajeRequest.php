<?php

namespace App\Http\Requests\Fichajes;

use Illuminate\Foundation\Http\FormRequest;

class StoreFichajeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'trabajador_id' => 'required|exists:trabajadores,id',
            'obra_id' => 'required|exists:obras,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'nullable|date_format:H:i|after:hora_entrada',
        ];
    }
}
