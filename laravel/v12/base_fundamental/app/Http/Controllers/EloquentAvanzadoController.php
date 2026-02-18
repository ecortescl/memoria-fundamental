<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EloquentAvanzadoController extends Controller
{
    // Página principal de ejemplos
    public function index()
    {
        return view('ejemplos.eloquent.index');
    }

    // Ejemplo 1: Relaciones y Eager Loading
    public function relaciones()
    {
        // ❌ MAL: N+1 Problem
        $productosMal = Producto::all();
        // Cada iteración hace una query adicional para categoria y etiquetas
        
        // ✅ BIEN: Eager Loading
        $productosBien = Producto::with(['categoria', 'etiquetas', 'imagenes'])->get();
        
        // ✅ MEJOR: Eager Loading con condiciones
        $productosOptimizado = Producto::with([
            'categoria:id,nombre,slug', // Solo campos necesarios
            'etiquetas' => function ($query) {
                $query->select('etiquetas.id', 'nombre', 'color')
                      ->orderBy('producto_etiqueta.orden');
            },
            'imagenes' => function ($query) {
                $query->select('id', 'imageable_id', 'imageable_type', 'url', 'orden')
                      ->limit(3);
            }
        ])->get();

        // Contar queries ejecutadas
        DB::enableQueryLog();
        $productosMal = Producto::limit(5)->get();
        foreach ($productosMal as $p) {
            $cat = $p->categoria?->nombre;
            $etiq = $p->etiquetas->count();
        }
        $queriesMal = count(DB::getQueryLog());
        
        DB::flushQueryLog();
        
        $productosBien = Producto::with(['categoria', 'etiquetas'])->limit(5)->get();
        foreach ($productosBien as $p) {
            $cat = $p->categoria?->nombre;
            $etiq = $p->etiquetas->count();
        }
        $queriesBien = count(DB::getQueryLog());
        
        DB::disableQueryLog();

        return view('ejemplos.eloquent.relaciones', compact(
            'productosOptimizado',
            'queriesMal',
            'queriesBien'
        ));
    }

    // Ejemplo 2: Relación Polimórfica
    public function polimorficas()
    {
        // Productos con sus imágenes
        $productos = Producto::with('imagenes')->limit(5)->get();
        
        // Categorías con sus imágenes
        $categorias = Categoria::with('imagenes')->limit(3)->get();
        
        // Todas las imágenes con su modelo relacionado
        $imagenes = \App\Models\Imagen::with('imageable')->limit(10)->get();

        return view('ejemplos.eloquent.polimorficas', compact('productos', 'categorias', 'imagenes'));
    }

    // Ejemplo 3: Pivot Personalizado
    public function pivotPersonalizado()
    {
        $productos = Producto::with(['etiquetas' => function ($query) {
            $query->orderBy('producto_etiqueta.orden');
        }])->limit(5)->get();

        return view('ejemplos.eloquent.pivot', compact('productos'));
    }

    // Ejemplo 4: Scopes Locales y Globales
    public function scopes()
    {
        // Scopes locales
        $activos = Producto::activos()->get();
        $conStock = Producto::conStock()->get();
        $stockBajo = Producto::stockBajo(10)->get();
        $populares = Producto::populares(100)->get();
        
        // Combinar scopes
        $activosConStock = Producto::activos()->conStock()->get();
        
        // Scope con relaciones
        $electronica = Producto::deCategoria(1)->with('categoria')->get();
        
        // Scope global (Categoria solo muestra activas por defecto)
        $categoriasActivas = Categoria::all(); // Solo activas
        $todasCategorias = Categoria::withoutGlobalScope('activa')->get(); // Todas

        return view('ejemplos.eloquent.scopes', compact(
            'activos',
            'conStock',
            'stockBajo',
            'populares',
            'activosConStock',
            'electronica',
            'categoriasActivas',
            'todasCategorias'
        ));
    }

    // Ejemplo 5: Accessors y Mutators Modernos
    public function accessorsMutators()
    {
        $productos = Producto::with('categoria')->limit(5)->get();

        return view('ejemplos.eloquent.accessors-mutators', compact('productos'));
    }

    // Ejemplo 6: Query Builder Avanzado con Subqueries
    public function queryAvanzado()
    {
        // Subquery: Productos con precio mayor al promedio
        $precioPromedio = Producto::avg('precio');
        $productosPremium = Producto::where('precio', '>', $precioPromedio)->get();

        // Subquery en select: Agregar conteo de etiquetas
        $productosConConteos = Producto::select('productos.*')
            ->withCount(['etiquetas', 'imagenes'])
            ->having('etiquetas_count', '>', 0)
            ->get();

        // Subquery en where: Productos de categorías con más de 2 productos
        $productosCategoriasPopulares = Producto::whereHas('categoria', function ($query) {
            $query->has('productos', '>=', 2);
        })->with('categoria')->get();

        // Subquery compleja: Ranking de productos por vistas en su categoría
        $ranking = Producto::select('productos.*')
            ->selectRaw('RANK() OVER (PARTITION BY categoria_id ORDER BY vistas DESC) as ranking')
            ->with('categoria')
            ->get()
            ->groupBy('categoria_id');

        // Agregaciones por categoría
        $estadisticasPorCategoria = Producto::select('categoria_id')
            ->selectRaw('COUNT(*) as total_productos')
            ->selectRaw('AVG(precio) as precio_promedio')
            ->selectRaw('SUM(stock) as stock_total')
            ->selectRaw('MAX(vistas) as max_vistas')
            ->groupBy('categoria_id')
            ->with('categoria')
            ->get();

        return view('ejemplos.eloquent.query-avanzado', compact(
            'precioPromedio',
            'productosPremium',
            'productosConConteos',
            'productosCategoriasPopulares',
            'ranking',
            'estadisticasPorCategoria'
        ));
    }

    // Ejemplo 7: Optimización e Indexación
    public function optimizacion()
    {
        // Mostrar índices de la tabla productos
        $indices = DB::select("PRAGMA index_list('productos')");
        
        // Explain de una query compleja
        $query = Producto::with(['categoria', 'etiquetas'])
            ->where('activo', true)
            ->where('stock', '>', 0)
            ->orderBy('vistas', 'desc');
        
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        // Comparación de performance
        $inicio = microtime(true);
        $sinIndice = Producto::where('vistas', '>', 100)->get();
        $tiempoSinOptimizar = (microtime(true) - $inicio) * 1000;

        $inicio = microtime(true);
        $conIndice = Producto::where('activo', true)->where('stock', '>', 0)->get();
        $tiempoOptimizado = (microtime(true) - $inicio) * 1000;

        return view('ejemplos.eloquent.optimizacion', compact(
            'indices',
            'sql',
            'bindings',
            'tiempoSinOptimizar',
            'tiempoOptimizado'
        ));
    }

    // Playground interactivo
    public function playground(Request $request)
    {
        $resultado = null;
        $error = null;
        $queries = [];
        $tiempo = 0;

        if ($request->has('codigo')) {
            try {
                DB::enableQueryLog();
                $inicio = microtime(true);
                
                // Importar clases necesarias en el contexto del eval
                $Producto = Producto::class;
                $Categoria = Categoria::class;
                $Etiqueta = Etiqueta::class;
                
                // Evaluar código de forma segura
                $codigo = $request->input('codigo');
                
                // Reemplazar nombres de clase por variables con namespace completo
                $codigo = str_replace('Producto::', '$Producto::', $codigo);
                $codigo = str_replace('Categoria::', '$Categoria::', $codigo);
                $codigo = str_replace('Etiqueta::', '$Etiqueta::', $codigo);
                
                $resultado = eval('return ' . $codigo . ';');
                
                $tiempo = (microtime(true) - $inicio) * 1000;
                $queries = DB::getQueryLog();
                DB::disableQueryLog();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                DB::disableQueryLog();
            }
        }

        return view('ejemplos.eloquent.playground', compact('resultado', 'error', 'queries', 'tiempo'));
    }
}
