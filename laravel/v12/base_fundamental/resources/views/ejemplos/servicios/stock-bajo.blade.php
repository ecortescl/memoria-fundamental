<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Bajo - Services</title>
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
        .producto { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #ef4444; border-radius: 4px; }
        .alert { background: #fef3c7; padding: 16px; border-left: 4px solid #f59e0b; margin: 12px 0; border-radius: 4px; color: #92400e; }
        pre { background: #1f2937; color: #10b981; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚠️ Productos con Stock Bajo</h1>
        
        <div class="card">
            <h2>Método del Service:</h2>
            <p>Este método busca productos con stock menor o igual a un límite específico.</p>
        </div>
        
        @if($productos->count() > 0)
            <div class="alert">
                <strong>Atención:</strong> Hay {{ $productos->count() }} producto(s) con stock bajo.
            </div>
            
            @foreach($productos as $producto)
                <div class="producto">
                    <h3>{{ $producto->nombre }}</h3>
                    <p>{{ $producto->descripcion }}</p>
                    <p><strong>Stock actual:</strong> {{ $producto->stock }} unidades</p>
                    <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                </div>
            @endforeach
        @else
            <div class="card">
                <p>✅ Todos los productos tienen stock suficiente.</p>
            </div>
        @endif
        
        <div class="card">
            <h3>💡 Uso del Service:</h3>
            <pre>$productos = $this->productoService->productosConStockBajo(5);</pre>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
