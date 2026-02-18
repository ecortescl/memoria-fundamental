<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Jobs\ActualizarPreciosJob;
use Illuminate\Http\Request;

class AvanzadosController extends Controller
{
    // Mostrar ejemplos de Factory y Seeder
    public function factorySeeder()
    {
        return view('ejemplos.avanzados.factory-seeder');
    }

    // Mostrar ejemplos de API
    public function api()
    {
        return view('ejemplos.avanzados.api');
    }

    // Mostrar ejemplos de Jobs y Queues
    public function jobsQueues()
    {
        return view('ejemplos.avanzados.jobs-queues');
    }

    // Despachar un Job de ejemplo
    public function despacharJob(Request $request)
    {
        $productoId = $request->input('producto_id');
        $porcentaje = $request->input('porcentaje', 10);

        // Despachar el job a la cola
        ActualizarPreciosJob::dispatch($productoId, $porcentaje);

        return redirect()->back()->with('success', "Job despachado para actualizar precio del producto #{$productoId} en {$porcentaje}%");
    }
}
