<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Query Optimization</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 16px; border-radius: 4px; }
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>🔍 Query Optimization</h1>

        <div class="card">
            <h2>❌ Problema N+1</h2>
            <div class="alert">
                <strong>Malo:</strong> 1 query + N queries adicionales
            </div>
            <pre><code>// 1 query para productos
$productos = Producto::all();  // SELECT * FROM productos

// N queries (una por cada producto)
foreach ($productos as $producto) {
    echo $producto->categoria->nombre;  // SELECT * FROM categorias WHERE id = ?
}

// Total: 1 + 100 = 101 queries si hay 100 productos</code></pre>
        </div>

        <div class="card">
            <h2>✅ Solución: Eager Loading</h2>
            <div class="success alert">
                <strong>Bueno:</strong> Solo 2 queries
            </div>
            <pre><code>// 2 queries total
$productos = Producto::with('categoria')->get();

// Query 1: SELECT * FROM productos
// Query 2: SELECT * FROM categorias WHERE id IN (1,2,3...)

foreach ($productos as $producto) {
    echo $producto->categoria->nombre;  // Sin query adicional
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Eager Loading múltiple</h2>
            <pre><code>// Cargar múltiples relaciones
$productos = Producto::with(['categoria', 'etiquetas', 'imagenes'])->get();

// Relaciones anidadas
$productos = Producto::with('categoria.padre')->get();

// Condicional
$productos = Producto::with(['etiquetas' => function ($query) {
    $query->where('activo', true);
}])->get();</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Select específico</h2>
            <pre><code>// ❌ Trae todas las columnas
$productos = Producto::all();

// ✅ Solo las necesarias
$productos = Producto::select('id', 'nombre', 'precio')->get();

// Con relaciones
$productos = Producto::select('id', 'nombre', 'categoria_id')
    ->with('categoria:id,nombre')
    ->get();</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Chunk para grandes datasets</h2>
            <pre><code>// Procesar en lotes de 100
Producto::chunk(100, function ($productos) {
    foreach ($productos as $producto) {
        // Procesar
    }
});

// O con cursor (menos memoria)
foreach (Producto::cursor() as $producto) {
    // Procesar uno por uno
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Índices en base de datos</h2>
            <pre><code>// En migración
Schema::table('productos', function (Blueprint $table) {
    $table->index('categoria_id');
    $table->index('activo');
    $table->index(['categoria_id', 'activo']);  // Compuesto
    $table->unique('slug');
});</code></pre>
        </div>

        <div class="card">
            <h2>📊 Debug queries</h2>
            <pre><code>// Ver queries ejecutadas
DB::enableQueryLog();

$productos = Producto::with('categoria')->get();

dd(DB::getQueryLog());

// O instalar Laravel Debugbar
composer require barryvdh/laravel-debugbar --dev</code></pre>
        </div>
    </div>
</body>
</html>
