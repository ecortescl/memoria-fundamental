<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Producto - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        .detail { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
        .detail strong { color: #1f2937; display: block; margin-bottom: 4px; }
        .btn { padding: 10px 20px; margin: 5px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: 500; font-size: 14px; border: none; cursor: pointer; }
        .btn-primary { background: #FF2D20; color: white; }
        .btn-primary:hover { background: #e02615; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .alert { padding: 16px; margin: 16px 0; border-radius: 4px; background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; color: #FF2D20; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>👁️ Ver Producto</h1>
        
        @if(session('success'))
            <div class="alert">✅ {{ session('success') }}</div>
        @endif
        
        <div class="card">
            <div class="detail">
                <strong>ID:</strong>
                {{ $producto->id }}
            </div>
            
            <div class="detail">
                <strong>Nombre:</strong>
                {{ $producto->nombre }}
            </div>
            
            <div class="detail">
                <strong>Descripción:</strong>
                {{ $producto->descripcion ?? 'Sin descripción' }}
            </div>
            
            <div class="detail">
                <strong>Precio:</strong>
                ${{ number_format($producto->precio, 2) }}
            </div>
            
            <div class="detail">
                <strong>Stock:</strong>
                {{ $producto->stock }} unidades
            </div>
            
            <div class="detail">
                <strong>Estado:</strong>
                {{ $producto->activo ? '✅ Activo' : '❌ Inactivo' }}
            </div>
            
            <div class="detail">
                <strong>Creado:</strong>
                {{ $producto->created_at->format('d/m/Y H:i') }}
            </div>
            
            <div class="detail">
                <strong>Actualizado:</strong>
                {{ $producto->updated_at->format('d/m/Y H:i') }}
            </div>
        </div>
        
        <div class="card">
            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">✏️ Editar</a>
            <form method="POST" action="{{ route('productos.destroy', $producto->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">🗑️ Eliminar</button>
            </form>
            <a href="{{ route('productos.index') }}">← Volver a la lista</a>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos Aprendidos:</h3>
            <ul>
                <li><code>Producto::findOrFail($id)</code> busca por ID o lanza error 404</li>
                <li><code>{{ $producto->nombre }}</code> accede a propiedades del modelo</li>
                <li><code>{{ $producto->descripcion ?? 'Default' }}</code> operador null coalescing</li>
                <li><code>$producto->created_at->format()</code> formatea fechas con Carbon</li>
                <li><code>@@method('DELETE')</code> simula método HTTP DELETE en formularios</li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
