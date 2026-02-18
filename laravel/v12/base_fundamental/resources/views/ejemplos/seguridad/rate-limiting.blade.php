<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rate Limiting</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 24px; border-radius: 4px; }
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; }
        .demo { background: #f3f4f6; padding: 16px; border-radius: 4px; margin: 16px 0; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>⏱️ Rate Limiting</h1>

        @if($bloqueado ?? false)
            <div class="alert">
                <strong>🚫 Bloqueado temporalmente</strong><br>
                Has excedido el límite de intentos. Espera {{ $segundos }} segundos.<br>
                Intentos realizados: {{ $intentos }}
            </div>
        @else
            <div class="success alert">
                <strong>✅ Acceso permitido</strong><br>
                Intentos: {{ $intentos }} / {{ $maxAttempts }}<br>
                <a href="/ejemplos/seguridad/rate-limiting">Recargar página</a>
            </div>
        @endif

        <div class="card">
            <h2>🔧 En rutas</h2>
            <pre><code>// routes/web.php
Route::middleware('throttle:60,1')->group(function () {
    // 60 requests por minuto
    Route::get('/api/productos', [ProductoController::class, 'index']);
});

// Diferentes límites por ruta
Route::post('/login')->middleware('throttle:5,1');  // 5 intentos/min
Route::post('/api/data')->middleware('throttle:100,1');  // 100 req/min</code></pre>
        </div>

        <div class="card">
            <h2>🔧 En controladores</h2>
            <pre><code>use Illuminate\Support\Facades\RateLimiter;

public function login(Request $request)
{
    $key = 'login:' . $request->ip();
    
    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);
        return response()->json([
            'message' => "Demasiados intentos. Espera {$seconds} segundos."
        ], 429);
    }
    
    RateLimiter::hit($key, 60); // 60 segundos
    
    // Lógica de login...
    
    // Si login exitoso, limpiar intentos
    RateLimiter::clear($key);
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Rate limiters personalizados</h2>
            <pre><code>// app/Providers/AppServiceProvider.php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

public function boot()
{
    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });
    
    RateLimiter::for('uploads', function (Request $request) {
        return Limit::perMinute(10)->by($request->user()->id);
    });
}</code></pre>
        </div>

        <div class="card">
            <h2>📊 Respuesta personalizada</h2>
            <pre><code>// Personalizar respuesta 429
Route::middleware('throttle:api')->group(function () {
    // ...
});

// En Handler.php
protected function throttled($request, $exception)
{
    return response()->json([
        'message' => 'Demasiadas peticiones',
        'retry_after' => $exception->getHeaders()['Retry-After']
    ], 429);
}</code></pre>
        </div>
    </div>
</body>
</html>
