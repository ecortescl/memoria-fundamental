<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DTOs</title>
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
        <h1>📦 DTOs (Data Transfer Objects)</h1>
        <p class="subtitle">Objetos inmutables para transferir datos entre capas</p>

        <div class="card">
            <h2>¿Qué es un DTO?</h2>
            <p>Un DTO transporta datos entre procesos de forma type-safe e inmutable.</p>
        </div>

        <div class="card">
            <h2>Ejemplo: ProductoDTO</h2>
            <pre><code>@@php
class ProductoDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly float $precio,
        public readonly int $stock,
        public readonly bool $activo,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nombre: $data['nombre'],
            precio: (float) $data['precio'],
            stock: (int) $data['stock'],
            activo: (bool) ($data['activo'] ?? true),
        );
    }

    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'activo' => $this->activo,
        ];
    }
}
@@endphp</code></pre>
        </div>

        <div class="card">
            <h2>Uso en el Flujo</h2>
            <pre><code>@@php
// Controller
public function store(StoreProductoRequest $request)
{
    $dto = $request->toDTO();
    $producto = $this->service->crearProducto($dto);
}

// Service
public function crearProducto(ProductoDTO $dto): Producto
{
    return $this->action->execute($dto);
}

// Action
public function execute(ProductoDTO $dto): Producto
{
    return Producto::create($dto->toArray());
}
@@endphp</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Ventajas:</strong>
            <ul>
                <li>Type Safety: El IDE autocompleta</li>
                <li>Inmutabilidad: Datos no cambian</li>
                <li>Documentación: Código autodocumentado</li>
                <li>Testing: Fácil crear DTOs para tests</li>
            </ul>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
