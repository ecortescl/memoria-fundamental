<?php

namespace App\Repositories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository para Producto
 * 
 * Encapsula la lógica de acceso a datos.
 * Útil cuando necesitas:
 * - Cambiar el origen de datos (DB, API, Cache)
 * - Queries complejas reutilizables
 * - Testing más fácil (puedes mockear el repository)
 * 
 * ⚠️ NO SIEMPRE ES NECESARIO:
 * - Para CRUDs simples, Eloquent es suficiente
 * - No agregues complejidad innecesaria
 */
class ProductoRepository
{
    /**
     * Obtener todos los productos activos con relaciones
     */
    public function getAllActivos(): Collection
    {
        return Producto::with(['categoria', 'etiquetas'])
            ->activos()
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Buscar productos por término
     */
    public function buscar(string $termino): Collection
    {
        return Producto::where('nombre', 'like', "%{$termino}%")
            ->orWhere('descripcion', 'like', "%{$termino}%")
            ->with('categoria')
            ->get();
    }

    /**
     * Obtener productos con stock bajo
     */
    public function getStockBajo(int $limite = 10): Collection
    {
        return Producto::stockBajo($limite)
            ->with('categoria')
            ->orderBy('stock')
            ->get();
    }

    /**
     * Obtener productos populares
     */
    public function getPopulares(int $limite = 10): Collection
    {
        return Producto::populares(100)
            ->with(['categoria', 'etiquetas'])
            ->limit($limite)
            ->get();
    }

    /**
     * Obtener productos por categoría
     */
    public function getPorCategoria(int $categoriaId): Collection
    {
        return Producto::deCategoria($categoriaId)
            ->activos()
            ->with('etiquetas')
            ->get();
    }

    /**
     * Obtener estadísticas de productos
     */
    public function getEstadisticas(): array
    {
        return [
            'total' => Producto::count(),
            'activos' => Producto::activos()->count(),
            'sin_stock' => Producto::where('stock', 0)->count(),
            'stock_bajo' => Producto::stockBajo()->count(),
            'precio_promedio' => Producto::avg('precio'),
            'stock_total' => Producto::sum('stock'),
        ];
    }

    /**
     * Crear producto
     */
    public function create(array $data): Producto
    {
        return Producto::create($data);
    }

    /**
     * Actualizar producto
     */
    public function update(Producto $producto, array $data): bool
    {
        return $producto->update($data);
    }

    /**
     * Eliminar producto
     */
    public function delete(Producto $producto): bool
    {
        return $producto->delete();
    }

    /**
     * Incrementar vistas de un producto
     */
    public function incrementarVistas(Producto $producto): void
    {
        $producto->incrementarVistas();
    }
}
