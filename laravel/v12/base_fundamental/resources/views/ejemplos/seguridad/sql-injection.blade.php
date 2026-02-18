<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection</title>
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
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        code { font-family: 'Courier New', monospace; font-size: 14px; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>💉 SQL Injection Protection</h1>

        <div class="alert">
            <strong>⚠️ ¿Qué es SQL Injection?</strong><br>
            Inyectar código SQL malicioso para acceder, modificar o eliminar datos de la base de datos.
        </div>

        <div class="card">
            <h2>❌ Vulnerable (Query crudo)</h2>
            <pre><code>// NUNCA hagas esto
$nombre = $_GET['nombre'];
$productos = DB::select("SELECT * FROM productos WHERE nombre = '$nombre'");

// Un atacante puede enviar:
// nombre = ' OR '1'='1
// Query resultante: SELECT * FROM productos WHERE nombre = '' OR '1'='1'
// Retorna TODOS los productos</code></pre>
        </div>

        <div class="card">
            <h2>✅ Protegido (Eloquent ORM)</h2>
            <pre><code>// Laravel protege automáticamente
$productos = Producto::where('nombre', $request->nombre)->get();

// O con Query Builder
$productos = DB::table('productos')
    ->where('nombre', $request->nombre)
    ->get();</code></pre>
        </div>

        <div class="card">
            <h2>✅ Protegido (Bindings)</h2>
            <pre><code>// Si necesitas SQL crudo, usa bindings
$productos = DB::select(
    'SELECT * FROM productos WHERE nombre = ?',
    [$request->nombre]
);

// O con nombres
$productos = DB::select(
    'SELECT * FROM productos WHERE nombre = :nombre AND precio > :precio',
    ['nombre' => $request->nombre, 'precio' => 100]
);</code></pre>
        </div>

        <div class="card">
            <h2>⚠️ Casos especiales</h2>
            <pre><code>// whereRaw con bindings
$productos = Producto::whereRaw('precio > ? AND stock > ?', [100, 10])->get();

// orderBy dinámico (validar primero)
$columna = in_array($request->sort, ['nombre', 'precio']) 
    ? $request->sort 
    : 'nombre';
    
$productos = Producto::orderBy($columna)->get();</code></pre>
        </div>

        <div class="success alert">
            <strong>✅ Buenas prácticas:</strong><br>
            • Usa Eloquent o Query Builder siempre que sea posible<br>
            • Si usas SQL crudo, SIEMPRE usa bindings<br>
            • Valida y sanitiza toda entrada de usuario<br>
            • Nunca concatenes variables directamente en SQL<br>
            • Usa prepared statements
        </div>
    </div>
</body>
</html>
