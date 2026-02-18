<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs y Queues - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
            padding: 40px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { 
            font-size: 36px;
            font-weight: 600;
            color: #FF2D20;
            margin-bottom: 12px;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin: 32px 0 16px;
        }
        h3 {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin: 24px 0 12px;
        }
        .subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 32px;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 14px;
            color: #FF2D20;
            font-family: 'Courier New', monospace;
        }
        pre {
            background: #1f2937;
            color: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            overflow-x: auto;
            margin: 16px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        pre code {
            background: none;
            color: inherit;
            padding: 0;
        }
        ul {
            margin: 16px 0;
            padding-left: 24px;
        }
        li {
            margin: 8px 0;
        }
        a {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        .highlight {
            background: #fef3c7;
            padding: 16px;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            margin: 16px 0;
        }
        .command {
            background: #1f2937;
            color: #10b981;
            padding: 12px 16px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            margin: 12px 0;
        }
        .success {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 16px;
            border-radius: 4px;
            margin: 16px 0;
        }
        form {
            background: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            margin-bottom: 16px;
            font-family: 'Figtree', sans-serif;
        }
        button {
            background: #FF2D20;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            font-family: 'Figtree', sans-serif;
        }
        button:hover {
            background: #e02615;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚡ Jobs y Queues</h1>
        <p class="subtitle">Ejecuta tareas pesadas en segundo plano</p>

        @if(session('success'))
        <div class="success">
            ✅ {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <h2>¿Qué son Jobs y Queues?</h2>
            <p><strong>Jobs:</strong> Tareas que se pueden ejecutar de forma asíncrona (en segundo plano).</p>
            <p><strong>Queues:</strong> Sistema de colas que gestiona la ejecución de estos jobs.</p>
            
            <h3>¿Por qué usarlos?</h3>
            <ul>
                <li>Mejorar el tiempo de respuesta de tu aplicación</li>
                <li>Procesar tareas pesadas sin bloquear al usuario</li>
                <li>Enviar emails, procesar imágenes, generar reportes</li>
                <li>Actualizar precios, sincronizar datos externos</li>
            </ul>
        </div>

        <div class="card">
            <h2>📁 Ejemplo de Job</h2>
            <h3>app/Jobs/ActualizarPreciosJob.php</h3>
            <pre><code>&lt;?php

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

    public function __construct(int $productoId, float $porcentaje)
    {
        $this->productoId = $productoId;
        $this->porcentaje = $porcentaje;
    }

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
}</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Despachar un Job</h2>
            <p>Prueba el sistema de colas despachando un job para actualizar el precio de un producto:</p>
            
            <form method="POST" action="/ejemplos/avanzados/despachar-job">
                @csrf
                <label for="producto_id">ID del Producto:</label>
                <input type="number" id="producto_id" name="producto_id" value="1" required>
                
                <label for="porcentaje">Porcentaje de Aumento:</label>
                <input type="number" id="porcentaje" name="porcentaje" value="10" step="0.01" required>
                
                <button type="submit">Despachar Job</button>
            </form>

            <h3>Desde el código:</h3>
            <pre><code>// Despachar inmediatamente
ActualizarPreciosJob::dispatch($productoId, $porcentaje);

// Despachar con delay
ActualizarPreciosJob::dispatch($productoId, $porcentaje)
    ->delay(now()->addMinutes(5));

// Despachar a una cola específica
ActualizarPreciosJob::dispatch($productoId, $porcentaje)
    ->onQueue('precios');</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Configuración de Queues</h2>
            
            <h3>1. Configurar el driver en .env:</h3>
            <pre><code># Para desarrollo (síncrono)
QUEUE_CONNECTION=sync

# Para producción (base de datos)
QUEUE_CONNECTION=database

# Otras opciones: redis, sqs, beanstalkd</code></pre>

            <h3>2. Crear tabla de jobs (si usas database):</h3>
            <div class="command">php artisan queue:table</div>
            <div class="command">php artisan migrate</div>

            <h3>3. Procesar la cola:</h3>
            <div class="command">php artisan queue:work</div>
            
            <h3>4. Procesar un solo job:</h3>
            <div class="command">php artisan queue:work --once</div>

            <h3>5. Ver jobs fallidos:</h3>
            <div class="command">php artisan queue:failed</div>

            <h3>6. Reintentar jobs fallidos:</h3>
            <div class="command">php artisan queue:retry all</div>
        </div>

        <div class="card">
            <h2>🛠️ Comandos Artisan</h2>
            
            <h3>Crear un Job:</h3>
            <div class="command">php artisan make:job ActualizarPreciosJob</div>
            
            <h3>Crear tabla de jobs fallidos:</h3>
            <div class="command">php artisan queue:failed-table</div>
            <div class="command">php artisan migrate</div>
        </div>

        <div class="card">
            <h2>💡 Conceptos Clave</h2>
            <ul>
                <li><code>ShouldQueue</code> - Interface que marca un job como "encolable"</li>
                <li><code>dispatch()</code> - Envía el job a la cola</li>
                <li><code>handle()</code> - Método que se ejecuta cuando se procesa el job</li>
                <li><code>queue:work</code> - Worker que procesa jobs continuamente</li>
                <li><code>delay()</code> - Retrasa la ejecución del job</li>
                <li><code>onQueue()</code> - Especifica la cola donde enviar el job</li>
                <li><code>tries</code> - Número de intentos antes de marcar como fallido</li>
                <li><code>timeout</code> - Tiempo máximo de ejecución</li>
            </ul>
        </div>

        <div class="card">
            <h2>📊 Drivers de Queue</h2>
            <ul>
                <li><strong>sync:</strong> Ejecuta inmediatamente (desarrollo)</li>
                <li><strong>database:</strong> Usa la base de datos (simple, sin dependencias)</li>
                <li><strong>redis:</strong> Rápido y eficiente (recomendado para producción)</li>
                <li><strong>sqs:</strong> Amazon SQS (para AWS)</li>
                <li><strong>beanstalkd:</strong> Sistema de colas dedicado</li>
            </ul>
        </div>

        <div class="highlight">
            <strong>💡 Tip:</strong> En producción, usa Supervisor para mantener el worker corriendo automáticamente. Si el worker se detiene, los jobs no se procesarán.
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
