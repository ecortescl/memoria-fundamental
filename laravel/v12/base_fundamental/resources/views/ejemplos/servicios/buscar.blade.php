<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos - Services</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1000px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h2 { color: #1f2937; font-size: 24px; font-weight: 600; margin-bottom: 16px; }
        h3 { color: #1f2937; font-size: 20px; font-weight: 600; margin-bottom: 12px; }
        input { padding: 12px; width: 70%; border: 1px solid #e5e7eb; border-radius: 4px; font-family: 'Figtree', sans-serif; }
        input:focus { outline: none; border-color: #FF2D20; }
        button { padding: 12px 24px; background: #FF2D20; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-family: 'Figtree', sans-serif; }
        button:hover { background: #e02615; }
        .producto { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
        pre { background: #1f2937; color: #10b981; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Buscar Productos</h1>
        
        <div class="card">
            <form method="GET" action="/ejemplos/servicios/buscar">
                <input type="text" name="q" value="{{ $termino }}" placeholder="Buscar por nombre o descripción...">
                <button type="submit">Buscar</button>
            </form>
        </div>
        
        @if($termino)
            <div class="card">
                <h2>Resultados para: "{{ $termino }}"</h2>
                
                @if($productos->count() > 0)
                    <p>Se encontraron {{ $productos->count() }} producto(s)</p>
                    
                    @foreach($productos as $producto)
                        <div class="producto">
                            <h3>{{ $producto->nombre }}</h3>
                            <p>{{ $producto->descripcion }}</p>
                            <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }} | <strong>Stock:</strong> {{ $producto->stock }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No se encontraron productos con ese término.</p>
                @endif
            </div>
        @endif
        
        <div class="card">
            <h3>💡 Método del Service:</h3>
            <pre>public function buscarPorNombre($termino)
{
    return Producto::where('nombre', 'like', "%{$termino}%")
        ->orWhere('descripcion', 'like', "%{$termino}%")
        ->get();
}</pre>
            <p>Este método busca en nombre y descripción usando el operador LIKE de SQL.</p>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
