<?php

namespace App\Actions;

use App\Models\Producto;
use App\DataTransferObjects\ProductoDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Action para crear un producto
 * 
 * Las Actions encapsulan una única operación de negocio.
 * Son clases con un solo método público (generalmente execute o handle).
 * 
 * Ventajas:
 * - Reutilizables desde controllers, jobs, commands
 * - Fáciles de testear
 * - Lógica de negocio aislada
 * - Single Responsibility Principle
 */
class CrearProductoAction
{
    /**
     * Ejecutar la acción de crear producto
     */
    public function execute(ProductoDTO $dto): Producto
    {
        // Validar DTO
        if (!$dto->isValid()) {
            throw new \InvalidArgumentException('Datos del producto inválidos');
        }

        // Usar transacción para operaciones atómicas
        return DB::transaction(function () use ($dto) {
            // Crear el producto
            $producto = Producto::create($dto->toArray());

            // Lógica adicional de negocio
            $this->aplicarReglasDeNegocio($producto);

            // Log de auditoría
            Log::info('Producto creado', [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'usuario' => auth()->id(),
            ]);

            return $producto;
        });
    }

    /**
     * Aplicar reglas de negocio específicas
     */
    private function aplicarReglasDeNegocio(Producto $producto): void
    {
        // Ejemplo: Si el precio es alto, marcar como premium
        if ($producto->precio > 1000) {
            // Aquí podrías agregar una etiqueta "Premium"
            // O enviar una notificación al equipo de ventas
        }

        // Ejemplo: Si el stock es bajo, notificar
        if ($producto->stock < 10) {
            // Despachar un job para notificar al equipo de inventario
            // dispatch(new NotificarStockBajoJob($producto));
        }
    }
}
