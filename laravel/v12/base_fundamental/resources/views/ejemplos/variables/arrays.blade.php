<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays - Laravel</title>
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
        .array-item { background: #f9fafb; padding: 12px; margin: 8px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
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
        <h1>📚 Arrays</h1>
        
        <div class="card">
            <h2>Código del Controlador:</h2>
            <div class="code-block">public function arrays()
{
    $frutas = ['Manzana', 'Banana', 'Naranja'];
    $persona = [
        'nombre' => 'María',
        'edad' => 30,
        'ciudad' => 'Madrid'
    ];
    
    return view('ejemplos.variables.arrays', 
        compact('frutas', 'persona')
    );
}</div>
        </div>
    
        <div class="card">
            <h2>Array Indexado</h2>
            <p><code>$frutas = ['Manzana', 'Banana', 'Naranja']</code></p>
            
            <h3>Resultado:</h3>
            @foreach($frutas as $fruta)
                <div class="array-item">🍎 {{ $fruta }}</div>
            @endforeach
            
            <h3>Con índices:</h3>
            @foreach($frutas as $index => $fruta)
                <div class="array-item">Índice {{ $index }}: {{ $fruta }}</div>
            @endforeach
        </div>
        
        <div class="card">
            <h2>Código Blade para Arrays:</h2>
            <div class="code-block">@@foreach($frutas as $fruta)
    &lt;div&gt;{{ $fruta }}&lt;/div&gt;
@@endforeach

{{-- Con índice --}}
@@foreach($frutas as $index => $fruta)
    &lt;div&gt;Índice {{ $index }}: {{ $fruta }}&lt;/div&gt;
@@endforeach</div>
        </div>
        
        <div class="card">
            <h2>Array Asociativo</h2>
            <p><code>$persona = ['nombre' => 'María', 'edad' => 30, 'ciudad' => 'Madrid']</code></p>
            
            <div class="array-item">
                <strong>Nombre:</strong> {{ $persona['nombre'] }}
            </div>
            <div class="array-item">
                <strong>Edad:</strong> {{ $persona['edad'] }} años
            </div>
            <div class="array-item">
                <strong>Ciudad:</strong> {{ $persona['ciudad'] }}
            </div>
            
            <h3>Iterando clave-valor:</h3>
            @foreach($persona as $clave => $valor)
                <div class="array-item">{{ $clave }}: {{ $valor }}</div>
            @endforeach
        </div>
        
        <div class="card">
            <h2>Código Blade para Arrays Asociativos:</h2>
            <div class="code-block">{{-- Acceso directo --}}
{{ $persona['nombre'] }}

{{-- Iterar clave-valor --}}
@@foreach($persona as $clave => $valor)
    &lt;div&gt;{{ $clave }}: {{ $valor }}&lt;/div&gt;
@@endforeach</div>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos Aprendidos:</h3>
            <ul>
                <li><code>@@foreach($array as $item)</code> itera sobre arrays</li>
                <li><code>@@foreach($array as $index => $item)</code> obtiene índice y valor</li>
                <li><code>@@forelse</code> maneja arrays vacíos con @@empty</li>
                <li>Arrays indexados: <code>$array[0]</code>, <code>$array[1]</code></li>
                <li>Arrays asociativos: <code>$array['clave']</code></li>
                <li>Variable <code>$loop</code> disponible: <code>$loop->first</code>, <code>$loop->last</code>, <code>$loop->index</code></li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
