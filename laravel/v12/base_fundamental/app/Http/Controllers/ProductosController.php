<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('ejemplos.productos.index', compact('productos'));
    }
    
    // Mostrar formulario de creación
    public function create()
    {
        return view('ejemplos.productos.create');
    }
    
    // Guardar nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        
        $producto = Producto::create($validated);
        
        return redirect()->route('productos.show', $producto->id)
            ->with('success', 'Producto creado exitosamente');
    }
    
    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('ejemplos.productos.show', compact('producto'));
    }
    
    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('ejemplos.productos.edit', compact('producto'));
    }
    
    // Actualizar producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        
        $producto->update($validated);
        
        return redirect()->route('productos.show', $producto->id)
            ->with('success', 'Producto actualizado exitosamente');
    }
    
    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
