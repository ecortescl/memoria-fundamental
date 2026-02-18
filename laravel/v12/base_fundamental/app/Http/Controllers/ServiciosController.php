<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    protected $productoService;
    
    // Inyección de dependencias
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }
    
    // Ejemplo: Usar servicio para obtener estadísticas
    public function estadisticas()
    {
        $estadisticas = $this->productoService->obtenerEstadisticas();
        return view('ejemplos.servicios.estadisticas', compact('estadisticas'));
    }
    
    // Ejemplo: Productos con stock bajo
    public function stockBajo()
    {
        $productos = $this->productoService->productosConStockBajo(5);
        return view('ejemplos.servicios.stock-bajo', compact('productos'));
    }
    
    // Ejemplo: Aplicar descuento
    public function aplicarDescuento(Request $request, $id)
    {
        $porcentaje = $request->input('porcentaje', 10);
        $resultado = $this->productoService->aplicarDescuento($id, $porcentaje);
        
        return view('ejemplos.servicios.descuento', compact('resultado'));
    }
    
    // Ejemplo: Buscar productos
    public function buscar(Request $request)
    {
        $termino = $request->input('q', '');
        $productos = $this->productoService->buscarPorNombre($termino);
        
        return view('ejemplos.servicios.buscar', compact('productos', 'termino'));
    }
}
