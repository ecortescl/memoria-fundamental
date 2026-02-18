<?php

namespace App\Actions;

use App\Models\Producto;
use App\DataTransferObjects\ProductoDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActualizarProductoAction
{
    public function execute(Producto $producto, ProductoDTO $dto): Producto
    {
        if (!$dto->isValid()) {
            throw new \InvalidArgumentException('Datos del producto inválidos');
        }

        return DB::transaction(function () use ($producto, $dto) {
            // Guardar valores anteriores para auditoría
            $valoresAnteriores = $producto->only(['precio', 'stock']);

            // Actualizar producto
            $producto->update($dto->toArray());

            // Detectar cambios importantes
            $this->detectarCambiosImportantes($producto, $valoresAnteriores);

            // Log de auditoría
            Log::info('Producto actualizado', [
                'producto_id' => $producto->id,
                'cambios' => $producto->getChanges(),
                'usuario' => auth()->id(),
            ]);

            return $producto->fresh();
        });
    }

    private function detectarCambiosImportantes(Producto $producto, array $valoresAnteriores): void
    {
        // Si el precio cambió significativamente
        if (isset($valoresAnteriores['precio'])) {
            $cambio = abs($producto->precio - $valoresAnteriores['precio']);
            $porcentaje = ($cambio / $valoresAnteriores['precio']) * 100;

            if ($porcentaje > 20) {
                // Notificar cambio de precio significativo
                Log::warning('Cambio de precio significativo', [
                    'producto_id' => $producto->id,
                    'precio_anterior' => $valoresAnteriores['precio'],
                    'precio_nuevo' => $producto->precio,
                    'porcentaje' => $porcentaje,
                ]);
            }
        }

        // Si el stock llegó a cero
        if ($producto->stock === 0 && $valoresAnteriores['stock'] > 0) {
            // Despachar evento o job
            Log::info('Producto sin stock', ['producto_id' => $producto->id]);
        }
    }
}
