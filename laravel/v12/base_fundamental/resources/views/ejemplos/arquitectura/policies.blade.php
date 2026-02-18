<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Policies</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 28px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin-bottom: 16px; }
        h3 { font-size: 18px; font-weight: 600; color: #374151; margin: 20px 0 12px; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; font-size: 13px; margin: 16px 0; line-height: 1.5; }
        .info-box { background: #dbeafe; border-left: 4px solid #3b82f6; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Policies & Gates</h1>
        <p class="subtitle">Centraliza la lógica de autorización</p>

        <div class="card">
            <h2>¿Qué son las Policies?</h2>
            <p>Las Policies encapsulan la lógica de autorización para un modelo específico.</p>
        </div>

        <div class="card">
            <h2>Crear una Policy</h2>
            <pre><code>php artisan make:policy ProductoPolicy --model=Producto</code></pre>
        </div>

        <div class="card">
            <h2>Ejemplo: ProductoPolicy</h2>
            <pre><code>@@php
class ProductoPolicy
{
    public function view(User $user, Producto $producto): bool
    {
        return $producto->activo || $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function update(User $user, Producto $producto): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        
        return $user->isManager() && $producto->activo;
    }

    public function delete(User $user, Producto $producto): bool
    {
        return $user->isAdmin() && !$producto->tieneVentas();
    }
}
@@endphp</code></pre>
        </div>

        <div class="card">
            <h2>Uso en Controllers</h2>
            <h3>Método 1: authorize()</h3>
            <pre><code>@@php
public function update(Request $request, Producto $producto)
{
    $this->authorize('update', $producto);
    $producto->update($request->all());
}
@@endphp</code></pre>

            <h3>Método 2: authorizeResource()</h3>
            <pre><code>@@php
public function __construct()
{
    $this->authorizeResource(Producto::class, 'producto');
}
@@endphp</code></pre>
        </div>

        <div class="card">
            <h2>Uso en Blade</h2>
            <pre><code>@@@@can('update', $producto)
    &lt;a href="{{ route('productos.edit', $producto) }}"&gt;Editar&lt;/a&gt;
@@@@endcan

@@@@can('delete', $producto)
    &lt;button&gt;Eliminar&lt;/button&gt;
@@@@endcan</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Gates vs Policies:</strong>
            <ul>
                <li><strong>Policies:</strong> Para modelos (ProductoPolicy)</li>
                <li><strong>Gates:</strong> Para acciones generales (ver-dashboard)</li>
            </ul>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
