<?php

namespace App\Http\Requests\Trabajadores;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrabajadorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:trabajadores,dni',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:trabajadores,email',
            'puesto' => 'required|string|max:255',
            'salario_hora' => 'required|numeric|min:0',
        ];
    }
}
