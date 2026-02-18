<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoApiController extends Controller
{
    /**
     * Listar todos los productos
     * GET /api/productos
     */
    public function index(): JsonResponse
    {
        $productos = Producto::all();
        
        return response()->json([
            'success' => true,
            'data' => $productos,
            'total' => $productos->count(),
        ]);
    }

    /**
     * Crear un nuevo producto
     * POST /api/productos
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
        ]);

        $producto = Producto::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente',
            'data' => $producto,
        ], 201);
    }

    /**
     * Mostrar un producto específico
     * GET /api/productos/{id}
     */
    public function show(string $id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $producto,
        ]);
    }

    /**
     * Actualizar un producto
     * PUT/PATCH /api/productos/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'activo' => 'boolean',
        ]);

        $producto->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado exitosamente',
            'data' => $producto,
        ]);
    }

    /**
     * Eliminar un producto
     * DELETE /api/productos/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado exitosamente',
        ]);
    }

    /**
     * Buscar productos
     * GET /api/productos/buscar?q=termino
     */
    public function buscar(Request $request): JsonResponse
    {
        $termino = $request->query('q', '');

        $productos = Producto::where('nombre', 'like', "%{$termino}%")
            ->orWhere('descripcion', 'like', "%{$termino}%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $productos,
            'total' => $productos->count(),
            'termino' => $termino,
        ]);
    }

    /**
     * Productos con stock bajo
     * GET /api/productos/stock-bajo?limite=10
     */
    public function stockBajo(Request $request): JsonResponse
    {
        $limite = $request->query('limite', 10);

        $productos = Producto::where('stock', '<=', $limite)
            ->where('activo', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $productos,
            'total' => $productos->count(),
            'limite' => $limite,
        ]);
    }
}
