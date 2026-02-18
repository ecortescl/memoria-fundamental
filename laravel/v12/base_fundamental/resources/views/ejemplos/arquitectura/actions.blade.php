<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actions</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 28px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin-bottom: 16px; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; font-size: 13px; margin: 16px 0; line-height: 1.5; }
        .info-box { background: #dbeafe; border-left: 4px solid #3b82f6; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚡ Actions</h1>
        <p class="subtitle">Clases con una sola responsabilidad para operaciones específicas</p>

        <div class="card">
            <h2>¿Qué es una Action?</h2>
            <p>Una Action encapsula UNA SOLA operación de negocio con un método <code>execute()</code>.</p>
        </div>

        <div class="card">
            <h2>Ejemplo: CrearProductoAction</h2>
            <pre><code>@@php
class CrearProductoAction
{
    public function execute(ProductoDTO $dto): Producto
    {
        if (!$dto->isValid()) {
            throw new \InvalidArgumentException('Datos inválidos');
        }

        return DB::transaction(function () use ($dto) {
            $producto = Producto::create($dto->toArray());
            
            if ($producto->precio > 1000) {
                // Marcar como premium
            }
            
            Log::info('Producto creado', ['id' => $producto->id]);
            
            return $producto;
        });
    }
}
@@endphp</code></pre>
        </div>

        <div class="card">
            <h2>Uso desde Controller</h2>
            <pre><code>@@php
public function __construct(
    private CrearProductoAction $crearAction
) {}

public function store(StoreProductoRequest $request)
{
    $producto = $this->crearAction->execute($request->toDTO());
    return redirect()->route('productos.index');
}
@@endphp</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Action vs Service:</strong>
            <ul>
                <li><strong>Action:</strong> Una operación (CrearProducto)</li>
                <li><strong>Service:</strong> Coordina múltiples actions</li>
            </ul>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
