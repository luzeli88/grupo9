<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'required|string',
            'precio_venta'  => 'required|numeric',
            'precio_compra' => 'nullable|numeric',
            'stock'         => 'nullable|integer',
            'stock_minimo'  => 'nullable|integer',
            'descuento'     => 'nullable|numeric',
            'imagen'        => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
