<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuebleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'categoria'   => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del mueble es obligatorio.',
            'precio.required' => 'Debés indicar un precio.',
            'precio.numeric'  => 'El precio debe ser un número.',
            'stock.required'  => 'Debés indicar el stock disponible.',
        ];
    }
}