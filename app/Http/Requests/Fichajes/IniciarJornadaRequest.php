<?php

namespace App\Http\Requests\Fichajes;

use Illuminate\Foundation\Http\FormRequest;

class IniciarJornadaRequest extends FormRequest
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
        ];
    }
}
