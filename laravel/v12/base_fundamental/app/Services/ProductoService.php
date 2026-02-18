<?php

namespace App\Services;

use App\Models\Producto;
use App\Repositories\ProductoRepository;
use App\Actions\CrearProductoAction;
use App\Actions\ActualizarProductoAction;
use App\DataTransferObjects\ProductoDTO;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service para Producto
 * 
 * Los Services coordinan múltiples operaciones y encapsulan lógica de negocio compleja.
 * Diferencia con Actions:
 * - Actions: Una sola operación específica
 * - Services: Coordinan múltiples actions/repositories
 * 
 * Cuándo usar Services:
 * - Lógica de negocio compleja
 * - Coordinación de múltiples modelos
 * - Operaciones que involucran varios pasos
 */
class ProductoService
{
    public function __construct(
        private ProductoRepository $repository,
        private CrearProductoAction $crearAction,
        private ActualizarProductoAction $actualizarAction,
    ) {}

    /**
     * Obtener productos con filtros
     */
    public function obtenerProductos(array $filtros = []): Collection
    {
        if (isset($filtros['buscar'])) {
            return $this->repository->buscar($filtros['buscar']);
        }

        if (isset($filtros['categoria_id'])) {
            return $this->repository->getPorCategoria($filtros['categoria_id']);
        }

        if (isset($filtros['populares'])) {
            return $this->repository->getPopulares($filtros['limite'] ?? 10);
        }

        if (isset($filtros['stock_bajo'])) {
            return $this->repository->getStockBajo($filtros['limite'] ?? 10);
        }

        return $this->repository->getAllActivos();
    }

    /**
     * Crear producto usando Action
     */
    public function crearProducto(ProductoDTO $dto): Producto
    {
        return $this->crearAction->execute($dto);
    }

    /**
     * Actualizar producto usando Action
     */
    public function actualizarProducto(Producto $producto, ProductoDTO $dto): Producto
    {
        return $this->actualizarAction->execute($producto, $dto);
    }

    /**
     * Eliminar producto
     */
    public function eliminarProducto(Producto $producto): bool
    {
        // Verificar que no tenga ventas
        if ($producto->tieneVentas()) {
            throw new \Exception('No se puede eliminar un producto con ventas');
        }

        return $this->repository->delete($producto);
    }

    /**
     * Obtener estadísticas
     */
    public function obtenerEstadisticas(): array
    {
        return $this->repository->getEstadisticas();
    }

    /**
     * Aplicar descuento a un producto
     */
    public function aplicarDescuento(Producto $producto, float $porcentaje): Producto
    {
        if ($porcentaje < 0 || $porcentaje > 100) {
            throw new \InvalidArgumentException('El porcentaje debe estar entre 0 y 100');
        }

        $nuevoPrecio = $producto->precio * (1 - $porcentaje / 100);
        
        $dto = new ProductoDTO(
            nombre: $producto->nombre,
            descripcion: $producto->descripcion,
            precio: $nuevoPrecio,
            stock: $producto->stock,
            activo: $producto->activo,
            categoriaId: $producto->categoria_id,
        );

        return $this->actualizarProducto($producto, $dto);
    }

    /**
     * Incrementar vistas de producto
     */
    public function registrarVista(Producto $producto): void
    {
        $this->repository->incrementarVistas($producto);
    }
}
