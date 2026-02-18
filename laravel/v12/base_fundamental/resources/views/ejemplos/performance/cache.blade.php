<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cache</title>
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
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>💾 Cache</h1>

        <div class="card">
            <h2>🔧 Cache básico</h2>
            <pre><code>use Illuminate\Support\Facades\Cache;

// Guardar por 1 hora
Cache::put('key', 'value', 3600);

// Guardar permanentemente
Cache::forever('key', 'value');

// Obtener
$value = Cache::get('key');

// Obtener o default
$value = Cache::get('key', 'default');

// Verificar existencia
if (Cache::has('key')) {
    //
}

// Eliminar
Cache::forget('key');</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Cache::remember</h2>
            <pre><code>// Si existe retorna, si no ejecuta closure y guarda
$productos = Cache::remember('productos-destacados', 3600, function () {
    return Producto::where('destacado', true)->get();
});

// Cache forever
$config = Cache::rememberForever('config-app', function () {
    return DB::table('configuracion')->get();
});</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Tags (Redis/Memcached)</h2>
            <pre><code>// Agrupar cache relacionado
Cache::tags(['productos', 'destacados'])->put('prod-1', $producto, 3600);
Cache::tags(['productos'])->put('prod-2', $producto2, 3600);

// Obtener
$producto = Cache::tags(['productos', 'destacados'])->get('prod-1');

// Limpiar por tag
Cache::tags(['productos'])->flush();  // Limpia prod-1 y prod-2</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Cache de queries</h2>
            <pre><code>// Cachear resultado de query
$productos = Producto::with('categoria')
    ->where('activo', true)
    ->remember(3600)  // Requiere spatie/laravel-query-cache
    ->get();

// O manualmente
$productos = Cache::remember('productos-activos', 3600, function () {
    return Producto::with('categoria')->where('activo', true)->get();
});</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Configuración Redis</h2>
            <pre><code># .env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Comandos útiles
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache</code></pre>
        </div>
    </div>
</body>
</html>
