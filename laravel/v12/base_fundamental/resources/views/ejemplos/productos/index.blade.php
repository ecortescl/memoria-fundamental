<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1100px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h2 { color: #1f2937; font-size: 24px; font-weight: 600; margin-bottom: 16px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; color: #1f2937; }
        .btn { padding: 8px 16px; margin: 2px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: 500; font-size: 14px; border: none; cursor: pointer; }
        .btn-primary { background: #FF2D20; color: white; }
        .btn-primary:hover { background: #e02615; }
        .btn-success { background: #10b981; color: white; }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .alert { padding: 16px; margin: 16px 0; border-radius: 4px; background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📦 Modelo y Controlador: Productos</h1>
        
        @if(session('success'))
            <div class="alert">✅ {{ session('success') }}</div>
        @endif
        
        <div class="card">
            <a href="{{ route('productos.create') }}" class="btn btn-success">➕ Crear Nuevo Producto</a>
        </div>
        
        <div class="card">
            <h2>Lista de Productos</h2>
            
            @if($productos->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>${{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->activo ? '✅ Activo' : '❌ Inactivo' }}</td>
                                <td>
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver</a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('productos.destroy', $producto->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay productos registrados. <a href="{{ route('productos.create') }}">Crear el primero</a></p>
            @endif
        </div>
        
        <div class="card">
            <h3>💡 Conceptos del Modelo:</h3>
            <ul>
                <li><code>Producto::all()</code> obtiene todos los registros</li>
                <li><code>$fillable</code> define campos que se pueden llenar masivamente</li>
                <li><code>$casts</code> convierte tipos de datos automáticamente</li>
                <li>Accessors modifican cómo se obtienen atributos</li>
                <li>Mutators modifican cómo se guardan atributos</li>
                <li>Scopes son consultas reutilizables</li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
