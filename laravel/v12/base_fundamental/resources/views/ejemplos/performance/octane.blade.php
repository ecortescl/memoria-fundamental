<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Laravel Octane</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
        .alert { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin-bottom: 24px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>🚀 Laravel Octane</h1>

        <div class="alert">
            <strong>💡 ¿Qué es Octane?</strong><br>
            Servidor de alto rendimiento que mantiene tu aplicación en memoria. Hasta 4x más rápido que PHP-FPM tradicional.
        </div>

        <div class="card">
            <h2>📦 Instalación</h2>
            <pre><code>composer require laravel/octane

# Con Swoole (recomendado)
php artisan octane:install --server=swoole

# O con RoadRunner
php artisan octane:install --server=roadrunner</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Ejecutar</h2>
            <pre><code># Desarrollo
php artisan octane:start

# Con watch (recarga automática)
php artisan octane:start --watch

# Producción
php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000 --workers=4</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Configuración</h2>
            <pre><code>// config/octane.php
'swoole' => [
    'options' => [
        'log_level' => 0,
        'package_max_length' => 10 * 1024 * 1024,
        'max_request' => 1000,  // Reiniciar worker cada 1000 requests
        'worker_num' => 4,  // Número de workers
    ],
],</code></pre>
        </div>

        <div class="card">
            <h2>⚠️ Consideraciones</h2>
            <pre><code>// ❌ No uses variables estáticas
class ProductoController
{
    public static $cache = [];  // Se comparte entre requests
}

// ✅ Usa el container
class ProductoController
{
    public function index(Request $request)
    {
        $cache = app('cache');  // Nueva instancia por request
    }
}

// Limpiar estado entre requests
public function boot()
{
    Octane::tick('1s', function () {
        // Ejecutar cada segundo
    });
    
    Octane::flushState();
}</code></pre>
        </div>

        <div class="card">
            <h2>📊 Benchmarks</h2>
            <pre><code># PHP-FPM tradicional
Requests per second: 100

# Laravel Octane
Requests per second: 400+

# Mejora: 4x más rápido</code></pre>
        </div>
    </div>
</body>
</html>
