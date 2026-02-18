<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables Básicas - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h2 { color: #1f2937; font-size: 24px; font-weight: 600; margin-bottom: 16px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        .variable { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
        .code-block { background: #1f2937; color: #10b981; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 14px; margin: 12px 0; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; color: #FF2D20; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Variables Básicas</h1>
        
        <div class="card">
            <h2>Código del Controlador:</h2>
            <div class="code-block">public function basicas()
{
    $nombre = "Juan";
    $edad = 25;
    $precio = 99.99;
    $activo = true;
    
    return view('ejemplos.variables.basicas', 
        compact('nombre', 'edad', 'precio', 'activo')
    );
}</div>
        </div>
    
        <div class="card">
            <h2>Variables Recibidas:</h2>
            
            <div class="variable">
                <strong>String:</strong> <code>$nombre</code>
                <p>Valor: {{ $nombre }}</p>
            </div>
            
            <div class="variable">
                <strong>Integer:</strong> <code>$edad</code>
                <p>Valor: {{ $edad }} años</p>
            </div>
            
            <div class="variable">
                <strong>Float:</strong> <code>$precio</code>
                <p>Valor: ${{ number_format($precio, 2) }}</p>
            </div>
            
            <div class="variable">
                <strong>Boolean:</strong> <code>$activo</code>
                <p>Valor: {{ $activo ? '✅ Activo' : '❌ Inactivo' }}</p>
            </div>
        </div>
        
        <div class="card">
            <h2>Código Blade de esta Vista:</h2>
            <div class="code-block">&lt;div class="variable"&gt;
    &lt;strong&gt;String:&lt;/strong&gt; &lt;code&gt;$nombre&lt;/code&gt;
    &lt;p&gt;Valor: @{{ $nombre }}&lt;/p&gt;
&lt;/div&gt;

&lt;div class="variable"&gt;
    &lt;strong&gt;Integer:&lt;/strong&gt; &lt;code&gt;$edad&lt;/code&gt;
    &lt;p&gt;Valor: @{{ $edad }} años&lt;/p&gt;
&lt;/div&gt;</div>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos Aprendidos:</h3>
            <ul>
                <li>Variables se pasan desde el controlador con <code>compact('nombre', 'edad')</code></li>
                <li>Se acceden en Blade con <code>@{{ $nombre }}</code> (sin el @)</li>
                <li>Blade escapa HTML automáticamente para seguridad</li>
                <li>Puedes usar funciones PHP como <code>number_format()</code></li>
                <li>Operador ternario: <code>@{{ $activo ? 'Sí' : 'No' }}</code></li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
