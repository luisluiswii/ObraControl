<?php

namespace App\Http\Requests\Obras;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObraRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:en curso,finalizada,pausada',
        ];
    }
}
