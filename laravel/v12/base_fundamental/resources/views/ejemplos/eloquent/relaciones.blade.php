<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relaciones y Eager Loading</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin: 32px 0 16px; }
        h3 { font-size: 18px; font-weight: 600; color: #374151; margin: 24px 0 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-size: 14px; color: #FF2D20; font-family: 'Courier New', monospace; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; margin: 16px 0; font-size: 14px; line-height: 1.5; }
        pre code { background: none; color: inherit; padding: 0; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { text-decoration: underline; }
        .alert-danger { background: #fee2e2; border-left: 4px solid #ef4444; padding: 16px; border-radius: 4px; margin: 16px 0; }
        .alert-success { background: #d1fae5; border-left: 4px solid #10b981; padding: 16px; border-radius: 4px; margin: 16px 0; }
        .alert-warning { background: #fef3c7; border-left: 4px solid: #f59e0b; padding: 16px; border-radius: 4px; margin: 16px 0; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600; margin: 2px; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .badge-green { background: #d1fae5; color: #065f46; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔗 Relaciones y Eager Loading</h1>
        <p class="subtitle">Evita el problema N+1 y optimiza tus queries</p>

        <div class="card">
            <h2>❌ El Problema N+1</h2>
            <p>Cuando cargas una colección y luego accedes a sus relaciones, se ejecuta una query por cada elemento.</p>
            
            <div class="alert-danger">
                <strong>⚠️ Queries ejecutadas (método malo):</strong> {{ $queriesMal }} queries
            </div>

            <h3>Código problemático:</h3>
            <pre><code>$productos = Producto::all(); // 1 query

foreach ($productos as $producto) {
    echo $producto->categoria->nombre; // +1 query por producto
    echo $producto->etiquetas->count(); // +1 query por producto
}

// Total: 1 + (N * 2) queries 😱</code></pre>
        </div>

        <div class="card">
            <h2>✅ Solución: Eager Loading</h2>
            <p>Carga todas las relaciones con solo 3 queries en total.</p>
            
            <div class="alert-success">
                <strong>✅ Queries ejecutadas (método bueno):</strong> {{ $queriesBien }} queries
            </div>

            <h3>Código optimizado:</h3>
            <pre><code>$productos = Producto::with(['categoria', 'etiquetas'])->get();

// Solo 3 queries:
// 1. SELECT * FROM productos
// 2. SELECT * FROM categorias WHERE id IN (...)
// 3. SELECT * FROM etiquetas INNER JOIN producto_etiqueta...</code></pre>
        </div>

        <div class="card">
            <h2>🎯 Eager Loading Optimizado</h2>
            <p>Carga solo los campos que necesitas y aplica condiciones.</p>

            <h3>Productos con relaciones optimizadas:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Etiquetas</th>
                        <th>Imágenes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productosOptimizado as $producto)
                    <tr>
                        <td>
                            <strong>{{ $producto->nombre }}</strong><br>
                            <small>{{ $producto->precio_formateado }}</small>
                        </td>
                        <td>
                            @if($producto->categoria)
                                <span class="badge badge-blue">{{ $producto->categoria->nombre }}</span>
                            @else
                                <span class="badge">Sin categoría</span>
                            @endif
                        </td>
                        <td>
                            @foreach($producto->etiquetas as $etiqueta)
                                <span class="badge" style="background: {{ $etiqueta->color }}20; color: {{ $etiqueta->color }};">
                                    {{ $etiqueta->nombre }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            {{ $producto->imagenes->count() }} imágenes
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Código usado:</h3>
            <pre><code>$productos = Producto::with([
    'categoria:id,nombre,slug', // Solo campos necesarios
    'etiquetas' => function ($query) {
        $query->select('etiquetas.id', 'nombre', 'color')
              ->orderBy('producto_etiqueta.orden');
    },
    'imagenes' => function ($query) {
        $query->select('id', 'imageable_id', 'imageable_type', 'url', 'orden')
              ->limit(3); // Solo primeras 3 imágenes
    }
])->get();</code></pre>
        </div>

        <div class="card">
            <h2>💡 Conceptos Clave</h2>
            <ul style="list-style: none; padding: 0;">
                <li style="margin: 8px 0;">→ <code>with()</code> - Eager loading de relaciones</li>
                <li style="margin: 8px 0;">→ <code>with('relacion:campo1,campo2')</code> - Solo campos específicos</li>
                <li style="margin: 8px 0;">→ <code>with(['relacion' => function($q) {}])</code> - Con condiciones</li>
                <li style="margin: 8px 0;">→ <code>load()</code> - Lazy eager loading (después de cargar el modelo)</li>
                <li style="margin: 8px 0;">→ <code>withCount()</code> - Solo contar relaciones</li>
                <li style="margin: 8px 0;">→ Problema N+1: 1 query inicial + N queries adicionales</li>
            </ul>
        </div>

        <div class="alert-warning">
            <strong>💡 Tip:</strong> Usa Laravel Debugbar o Telescope para visualizar todas las queries ejecutadas y detectar problemas N+1.
        </div>

        <a href="/ejemplos/eloquent">← Volver a Eloquent Avanzado</a>
    </div>
</body>
</html>
