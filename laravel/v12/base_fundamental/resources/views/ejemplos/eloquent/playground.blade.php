<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eloquent Playground</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 1400px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; }
        textarea { width: 100%; min-height: 200px; padding: 16px; border: 1px solid #d1d5db; border-radius: 4px; font-family: 'Courier New', monospace; font-size: 14px; }
        button { background: #FF2D20; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-family: 'Figtree', sans-serif; }
        button:hover { background: #e02615; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; margin: 16px 0; font-size: 14px; line-height: 1.5; }
        .alert-danger { background: #fee2e2; border-left: 4px solid #ef4444; padding: 16px; border-radius: 4px; margin: 16px 0; }
        .alert-success { background: #d1fae5; border-left: 4px solid #10b981; padding: 16px; border-radius: 4px; margin: 16px 0; }
        .ejemplos { background: #f9fafb; padding: 16px; border-radius: 4px; margin: 16px 0; }
        .ejemplos code { background: #fff; padding: 8px 12px; display: block; margin: 8px 0; border-radius: 4px; cursor: pointer; }
        .ejemplos code:hover { background: #e5e7eb; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        .stats { display: flex; gap: 16px; margin: 16px 0; }
        .stat { background: #f3f4f6; padding: 12px; border-radius: 4px; flex: 1; }
        .stat strong { display: block; font-size: 24px; color: #FF2D20; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 Eloquent Playground</h1>
        <p class="subtitle">Prueba queries de Eloquent en tiempo real</p>

        <div class="grid">
            <div class="card">
                <h2 style="margin-bottom: 16px;">Escribe tu código Eloquent</h2>
                
                <form method="POST">
                    @csrf
                    <textarea name="codigo" placeholder="Producto::with('categoria')->get()">{{ old('codigo', request('codigo')) }}</textarea>
                    <button type="submit" style="margin-top: 16px;">▶️ Ejecutar</button>
                </form>

                <div class="ejemplos">
                    <strong>💡 Ejemplos para probar:</strong>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Producto::with('categoria', 'etiquetas')->get()</code>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Producto::activos()->conStock()->get()</code>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Producto::withCount('etiquetas', 'imagenes')->get()</code>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Categoria::with('productos')->get()</code>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Producto::where('precio', '>', 500)->with('categoria')->get()</code>
                    <code onclick="document.querySelector('textarea').value = this.textContent">Producto::populares(100)->with('categoria')->get()</code>
                </div>
            </div>

            <div class="card">
                <h2 style="margin-bottom: 16px;">Resultado</h2>

                @if($error)
                    <div class="alert-danger">
                        <strong>❌ Error:</strong><br>
                        {{ $error }}
                    </div>
                @endif

                @if($resultado !== null)
                    <div class="alert-success">
                        ✅ Ejecutado exitosamente
                    </div>

                    <div class="stats">
                        <div class="stat">
                            <strong>{{ count($queries) }}</strong>
                            <span>Queries</span>
                        </div>
                        <div class="stat">
                            <strong>{{ number_format($tiempo, 2) }}ms</strong>
                            <span>Tiempo</span>
                        </div>
                        <div class="stat">
                            <strong>{{ is_countable($resultado) ? count($resultado) : 1 }}</strong>
                            <span>Resultados</span>
                        </div>
                    </div>

                    <h3 style="margin-top: 24px;">Datos:</h3>
                    <pre>{{ json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                    @if(count($queries) > 0)
                        <h3 style="margin-top: 24px;">Queries SQL ejecutadas:</h3>
                        @foreach($queries as $index => $query)
                            <pre><code>-- Query {{ $index + 1 }} ({{ number_format($query['time'], 2) }}ms)
{{ $query['query'] }}

-- Bindings: {{ json_encode($query['bindings']) }}</code></pre>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>

        <div class="card" style="margin-top: 24px;">
            <h2>📚 Modelos disponibles</h2>
            <ul style="list-style: none; padding: 0; display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                <li>→ <code>Producto</code></li>
                <li>→ <code>Categoria</code></li>
                <li>→ <code>Etiqueta</code></li>
                <li>→ <code>Imagen</code></li>
                <li>→ <code>ProductoEtiqueta</code></li>
            </ul>

            <h3 style="margin-top: 24px;">Scopes disponibles en Producto:</h3>
            <ul style="list-style: none; padding: 0; display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                <li>→ <code>activos()</code></li>
                <li>→ <code>conStock()</code></li>
                <li>→ <code>stockBajo($limite)</code></li>
                <li>→ <code>populares($minVistas)</code></li>
                <li>→ <code>deCategoria($id)</code></li>
                <li>→ <code>conEtiqueta($nombre)</code></li>
            </ul>
        </div>

        <a href="/ejemplos/eloquent">← Volver a Eloquent Avanzado</a>
    </div>
</body>
</html>
