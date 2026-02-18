<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        .form-group { margin: 16px 0; }
        label { display: block; margin-bottom: 8px; font-weight: 500; color: #1f2937; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 4px; box-sizing: border-box; font-family: 'Figtree', sans-serif; }
        input:focus, textarea:focus { outline: none; border-color: #FF2D20; }
        button { padding: 12px 24px; background: #FF2D20; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; font-family: 'Figtree', sans-serif; }
        button:hover { background: #e02615; }
        .error { color: #ef4444; font-size: 14px; margin-top: 4px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; color: #FF2D20; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Crear Nuevo Producto</h1>
        
        <div class="card">
            <form method="POST" action="{{ route('productos.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio') }}" required>
                    @error('precio')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                    @error('stock')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit">💾 Guardar Producto</button>
                <a href="{{ route('productos.index') }}" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos del Controlador:</h3>
            <ul>
                <li><code>@@csrf</code> token de seguridad obligatorio en formularios</li>
                <li><code>old('campo')</code> mantiene valores después de error de validación</li>
                <li><code>@@error('campo')</code> muestra errores de validación</li>
                <li><code>$request->validate()</code> valida datos del formulario</li>
                <li><code>Producto::create()</code> crea nuevo registro</li>
                <li><code>redirect()->route()</code> redirige a otra ruta</li>
                <li><code>with('success', 'mensaje')</code> envía mensaje flash</li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
