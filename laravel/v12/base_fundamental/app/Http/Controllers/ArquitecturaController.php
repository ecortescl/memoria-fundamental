<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Services\ProductoService;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;

/**
 * Controlador con Arquitectura Limpia
 * 
 * Este controlador demuestra las best practices:
 * - Delgado (thin controller)
 * - Usa Form Requests para validación
 * - Delega lógica a Services/Actions
 * - Usa Policies para autorización
 * - Retorna respuestas consistentes
 */
class ArquitecturaController extends Controller
{
    public function __construct(
        private ProductoService $productoService
    ) {
        // Aplicar policies automáticamente
        $this->authorizeResource(Producto::class, 'producto');
    }

    /**
     * Página principal de ejemplos
     */
    public function index()
    {
        return view('ejemplos.arquitectura.index');
    }

    /**
     * Ejemplo: Controller Limpio
     */
    public function controllerLimpio()
    {
        // El controller solo coordina, no tiene lógica de negocio
        $productos = $this->productoService->obtenerProductos();
        $estadisticas = $this->productoService->obtenerEstadisticas();

        return view('ejemplos.arquitectura.controller-limpio', compact('productos', 'estadisticas'));
    }

    /**
     * Ejemplo: Form Requests
     */
    public function formRequests()
    {
        return view('ejemplos.arquitectura.form-requests');
    }

    /**
     * Ejemplo: DTOs
     */
    public function dtos()
    {
        $productos = Producto::with('categoria')->limit(5)->get();
        
        // Convertir modelos a DTOs
        $productoDTOs = $productos->map(fn($p) => \App\DataTransferObjects\ProductoDTO::fromModel($p));

        return view('ejemplos.arquitectura.dtos', compact('productoDTOs'));
    }

    /**
     * Ejemplo: Actions
     */
    public function actions()
    {
        return view('ejemplos.arquitectura.actions');
    }

    /**
     * Ejemplo: Services
     */
    public function services()
    {
        $estadisticas = $this->productoService->obtenerEstadisticas();
        $populares = $this->productoService->obtenerProductos(['populares' => true, 'limite' => 5]);
        $stockBajo = $this->productoService->obtenerProductos(['stock_bajo' => true, 'limite' => 5]);

        return view('ejemplos.arquitectura.services', compact('estadisticas', 'populares', 'stockBajo'));
    }

    /**
     * Ejemplo: Repositories
     */
    public function repositories()
    {
        return view('ejemplos.arquitectura.repositories');
    }

    /**
     * Ejemplo: Policies
     */
    public function policies()
    {
        $productos = Producto::limit(5)->get();

        return view('ejemplos.arquitectura.policies', compact('productos'));
    }

    /**
     * Ejemplo: Comparación (Malo vs Bueno)
     */
    public function comparacion()
    {
        return view('ejemplos.arquitectura.comparacion');
    }

    /**
     * Demostración de crear producto con arquitectura limpia
     */
    public function store(StoreProductoRequest $request)
    {
        // ✅ Validación ya hecha por Form Request
        // ✅ Autorización ya hecha por Policy
        // ✅ Lógica de negocio en Action/Service

        $producto = $this->productoService->crearProducto($request->toDTO());

        return redirect()
            ->route('arquitectura.controller-limpio')
            ->with('success', "Producto '{$producto->nombre}' creado exitosamente");
    }

    /**
     * Demostración de actualizar producto
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $productoActualizado = $this->productoService->actualizarProducto($producto, $request->toDTO());

        return redirect()
            ->route('arquitectura.controller-limpio')
            ->with('success', "Producto actualizado exitosamente");
    }

    /**
     * Demostración de eliminar producto
     */
    public function destroy(Producto $producto)
    {
        try {
            $this->productoService->eliminarProducto($producto);
            
            return redirect()
                ->route('arquitectura.controller-limpio')
                ->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
