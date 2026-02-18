<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'precio' => ['sometimes', 'required', 'numeric', 'min:0', 'max:999999.99'],
            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'activo' => ['boolean'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.min' => 'El precio debe ser mayor o igual a 0',
            'stock.min' => 'El stock no puede ser negativo',
        ];
    }

    public function toDTO(): \App\DataTransferObjects\ProductoDTO
    {
        $validated = $this->validated();
        
        // Para updates, necesitamos los datos actuales del producto
        $producto = $this->route('producto');
        
        return new \App\DataTransferObjects\ProductoDTO(
            nombre: $validated['nombre'] ?? $producto->nombre,
            descripcion: $validated['descripcion'] ?? $producto->descripcion,
            precio: $validated['precio'] ?? $producto->precio,
            stock: $validated['stock'] ?? $producto->stock,
            activo: $validated['activo'] ?? $producto->activo,
            categoriaId: $validated['categoria_id'] ?? $producto->categoria_id,
        );
    }
}
