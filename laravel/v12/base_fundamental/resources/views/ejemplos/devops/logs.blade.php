<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logs</title>
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
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/devops" class="back">← Volver</a>
        
        <h1>📝 Logs</h1>

        <div class="card">
            <h2>🔧 Niveles de log</h2>
            <pre><code>use Illuminate\Support\Facades\Log;

// Debug (desarrollo)
Log::debug('Variable value', ['var' => $value]);

// Info (información general)
Log::info('Usuario logueado', ['user_id' => $user->id]);

// Notice (eventos normales pero significativos)
Log::notice('Configuración actualizada');

// Warning (advertencias)
Log::warning('Stock bajo', ['producto_id' => $producto->id]);

// Error (errores que no detienen la app)
Log::error('Error al enviar email', ['error' => $e->getMessage()]);

// Critical (errores críticos)
Log::critical('Base de datos no disponible');

// Alert (acción inmediata requerida)
Log::alert('Disco lleno al 95%');

// Emergency (sistema inutilizable)
Log::emergency('Servidor caído');</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Canales personalizados</h2>
            <pre><code>// config/logging.php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single', 'slack'],
    ],
    
    'single' => [
        'driver' => 'single',
        'path' => storage_path('logs/laravel.log'),
        'level' => 'debug',
    ],
    
    'slack' => [
        'driver' => 'slack',
        'url' => env('LOG_SLACK_WEBHOOK_URL'),
        'level' => 'critical',
    ],
    
    'custom' => [
        'driver' => 'daily',
        'path' => storage_path('logs/custom.log'),
        'days' => 14,
    ],
];

// Usar canal específico
Log::channel('slack')->critical('Error crítico');
Log::stack(['single', 'slack'])->error('Error importante');</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Context y stack traces</h2>
            <pre><code>try {
    $producto = Producto::findOrFail($id);
} catch (\Exception $e) {
    Log::error('Error al obtener producto', [
        'producto_id' => $id,
        'user_id' => auth()->id(),
        'ip' => request()->ip(),
        'exception' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
    
    throw $e;
}</code></pre>
        </div>

        <div class="card">
            <h2>📊 Ver logs</h2>
            <pre><code># Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Últimas 100 líneas
tail -n 100 storage/logs/laravel.log

# Buscar errores
grep "ERROR" storage/logs/laravel.log

# Limpiar logs antiguos
find storage/logs -name "*.log" -mtime +30 -delete</code></pre>
        </div>
    </div>
</body>
</html>
