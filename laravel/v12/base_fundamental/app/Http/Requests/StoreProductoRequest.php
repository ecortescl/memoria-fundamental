<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear productos
 * 
 * Encapsula la validación y autorización en una clase dedicada.
 * Mantiene los controladores limpios y la lógica de validación reutilizable.
 */
class StoreProductoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición
     */
    public function authorize(): bool
    {
        // Aquí puedes agregar lógica de autorización
        // Por ejemplo: return $this->user()->can('create', Producto::class);
        return true;
    }

    /**
     * Reglas de validación
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'precio' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'activo' => ['boolean'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
        ];
    }

    /**
     * Mensajes de error personalizados
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'precio.required' => 'El precio es obligatorio',
            'precio.min' => 'El precio debe ser mayor o igual a 0',
            'stock.required' => 'El stock es obligatorio',
            'stock.min' => 'El stock no puede ser negativo',
            'categoria_id.exists' => 'La categoría seleccionada no existe',
        ];
    }

    /**
     * Nombres personalizados de atributos
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del producto',
            'descripcion' => 'descripción',
            'precio' => 'precio',
            'stock' => 'stock',
            'categoria_id' => 'categoría',
        ];
    }

    /**
     * Preparar datos para validación
     */
    protected function prepareForValidation(): void
    {
        // Normalizar datos antes de validar
        $this->merge([
            'activo' => $this->boolean('activo', true),
        ]);
    }

    /**
     * Obtener datos validados como DTO
     */
    public function toDTO(): \App\DataTransferObjects\ProductoDTO
    {
        return \App\DataTransferObjects\ProductoDTO::fromArray($this->validated());
    }
}
