<?php

namespace App\Jobs;

use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ActualizarPreciosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $porcentaje;
    public $productoId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $productoId, float $porcentaje)
    {
        $this->productoId = $productoId;
        $this->porcentaje = $porcentaje;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $producto = Producto::find($this->productoId);
        
        if ($producto) {
            $precioAnterior = $producto->precio;
            $producto->precio = $producto->precio * (1 + $this->porcentaje / 100);
            $producto->save();
            
            Log::info("Precio actualizado", [
                'producto_id' => $this->productoId,
                'precio_anterior' => $precioAnterior,
                'precio_nuevo' => $producto->precio,
                'porcentaje' => $this->porcentaje,
            ]);
        }
    }
}
