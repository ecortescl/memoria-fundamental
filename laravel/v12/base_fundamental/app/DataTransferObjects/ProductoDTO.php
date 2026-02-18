<?php

namespace App\DataTransferObjects;

/**
 * Data Transfer Object para Producto
 * 
 * Los DTOs encapsulan datos y los transfieren entre capas de la aplicación.
 * Son inmutables y solo contienen datos, sin lógica de negocio.
 */
class ProductoDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly ?string $descripcion,
        public readonly float $precio,
        public readonly int $stock,
        public readonly bool $activo,
        public readonly ?int $categoriaId = null,
    ) {}

    /**
     * Crear DTO desde un array (útil para requests)
     */
    public static function fromArray(array $data): self
    {
        return new self(
            nombre: $data['nombre'],
            descripcion: $data['descripcion'] ?? null,
            precio: (float) $data['precio'],
            stock: (int) $data['stock'],
            activo: (bool) ($data['activo'] ?? true),
            categoriaId: isset($data['categoria_id']) ? (int) $data['categoria_id'] : null,
        );
    }

    /**
     * Crear DTO desde un modelo
     */
    public static function fromModel(\App\Models\Producto $producto): self
    {
        return new self(
            nombre: $producto->nombre,
            descripcion: $producto->descripcion,
            precio: $producto->precio,
            stock: $producto->stock,
            activo: $producto->activo,
            categoriaId: $producto->categoria_id,
        );
    }

    /**
     * Convertir a array (útil para crear/actualizar modelos)
     */
    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'activo' => $this->activo,
            'categoria_id' => $this->categoriaId,
        ];
    }

    /**
     * Validar datos del DTO
     */
    public function isValid(): bool
    {
        return !empty($this->nombre) 
            && $this->precio >= 0 
            && $this->stock >= 0;
    }
}
