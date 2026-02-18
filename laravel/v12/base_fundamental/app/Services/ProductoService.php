<?php

namespace App\Services;

use App\Models\Producto;

class ProductoService
{
    /**
     * Obtener productos con stock bajo
     */
    public function productosConStockBajo($limite = 10)
    {
        return Producto::where('stock', '<=', $limite)
            ->where('activo', true)
            ->get();
    }
    
    /**
     * Calcular valor total del inventario
     */
    public function calcularValorInventario()
    {
        return Producto::sum(\DB::raw('precio * stock'));
    }
    
    /**
     * Aplicar descuento a un producto
     */
    public function aplicarDescuento($productoId, $porcentaje)
    {
        $producto = Producto::findOrFail($productoId);
        $precioOriginal = $producto->precio;
        $descuento = $precioOriginal * ($porcentaje / 100);
        $producto->precio = $precioOriginal - $descuento;
        $producto->save();
        
        return [
            'producto' => $producto,
            'precio_original' => $precioOriginal,
            'descuento_aplicado' => $descuento,
            'precio_final' => $producto->precio
        ];
    }
    
    /**
     * Buscar productos por nombre
     */
    public function buscarPorNombre($termino)
    {
        return Producto::where('nombre', 'like', "%{$termino}%")
            ->orWhere('descripcion', 'like', "%{$termino}%")
            ->get();
    }
    
    /**
     * Obtener estadísticas de productos
     */
    public function obtenerEstadisticas()
    {
        return [
            'total_productos' => Producto::count(),
            'productos_activos' => Producto::where('activo', true)->count(),
            'productos_sin_stock' => Producto::where('stock', 0)->count(),
            'precio_promedio' => Producto::avg('precio'),
            'stock_total' => Producto::sum('stock'),
        ];
    }
}
