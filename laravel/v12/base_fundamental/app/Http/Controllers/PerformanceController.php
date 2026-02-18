<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class PerformanceController extends Controller
{
    public function index()
    {
        return view('ejemplos.performance.index');
    }

    public function cache()
    {
        $productos = Cache::remember('productos-destacados', 3600, function () {
            sleep(2); // Simular query lenta
            return Producto::where('activo', true)->take(10)->get();
        });
        
        return view('ejemplos.performance.cache', compact('productos'));
    }

    public function queryOptimization()
    {
        // Ejemplo N+1
        $productosMalo = Producto::with('categoria')->take(5)->get();
        
        // Optimizado
        $productosBueno = Producto::with(['categoria', 'etiquetas'])->take(5)->get();
        
        return view('ejemplos.performance.query-optimization', compact('productosMalo', 'productosBueno'));
    }

    public function lazyCollections()
    {
        return view('ejemplos.performance.lazy-collections');
    }

    public function horizon()
    {
        return view('ejemplos.performance.horizon');
    }

    public function octane()
    {
        return view('ejemplos.performance.octane');
    }

    public function configCache()
    {
        return view('ejemplos.performance.config-cache');
    }

    public function docker()
    {
        return view('ejemplos.performance.docker');
    }
}
