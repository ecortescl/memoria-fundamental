<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lazy Collections</title>
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
        
        <h1>🔄 Lazy Collections</h1>

        <div class="card">
            <h2>❌ Problema: Memoria</h2>
            <pre><code>// Carga 1 millón de registros en memoria (puede crashear)
$productos = Producto::all();  // ~500MB de RAM

foreach ($productos as $producto) {
    // Procesar
}</code></pre>
        </div>

        <div class="card">
            <h2>✅ Solución: Lazy Collection</h2>
            <pre><code>// Procesa uno por uno, sin cargar todo en memoria
$productos = Producto::cursor();  // ~1MB de RAM

foreach ($productos as $producto) {
    // Procesar
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Lazy desde archivo</h2>
            <pre><code>use Illuminate\Support\LazyCollection;

// Leer archivo CSV grande línea por línea
LazyCollection::make(function () {
    $handle = fopen('productos.csv', 'r');
    
    while (($line = fgets($handle)) !== false) {
        yield $line;
    }
    
    fclose($handle);
})
->skip(1)  // Saltar header
->map(function ($line) {
    return str_getcsv($line);
})
->chunk(100)
->each(function ($chunk) {
    Producto::insert($chunk->toArray());
});</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Operaciones lazy</h2>
            <pre><code>Producto::cursor()
    ->filter(function ($producto) {
        return $producto->precio > 100;
    })
    ->map(function ($producto) {
        return [
            'nombre' => $producto->nombre,
            'precio_con_iva' => $producto->precio * 1.19
        ];
    })
    ->take(1000)
    ->each(function ($item) {
        // Procesar
    });</code></pre>
        </div>

        <div class="card">
            <h2>📊 Comparación</h2>
            <pre><code>// Collection normal (eager)
$productos = Producto::all();  // Carga todo en memoria
$filtrados = $productos->filter(...)->map(...);

// Lazy Collection
$productos = Producto::cursor();  // Procesa bajo demanda
$filtrados = $productos->filter(...)->map(...);</code></pre>
        </div>
    </div>
</body>
</html>
