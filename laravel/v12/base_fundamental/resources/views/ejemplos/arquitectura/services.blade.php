<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
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
        .warning-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Services</h1>
        <p class="subtitle">Coordinan múltiples operaciones y encapsulan lógica compleja</p>

        <div class="card">
            <h2>¿Qué es un Service?</h2>
            <p>Un Service coordina múltiples Actions, Repositories y lógica de negocio compleja.</p>
        </div>

        <div class="card">
            <h2>Ejemplo: ProductoService</h2>
            <pre><code>@@php
class ProductoService
{
    public function __construct(
        private ProductoRepository $repository,
        private CrearProductoAction $crearAction,
        private ActualizarProductoAction $actualizarAction,
    ) {}

    public function crearProducto(ProductoDTO $dto): Producto
    {
        return $this->crearAction->execute($dto);
    }

    public function obtenerProductos(array $filtros = []): Collection
    {
        if (isset($filtros['buscar'])) {
            return $this->repository->buscar($filtros['buscar']);
        }
        
        return $this->repository->getAllActivos();
    }

    public function aplicarDescuento(Producto $producto, float $porcentaje): Producto
    {
        $nuevoPrecio = $producto->precio * (1 - $porcentaje / 100);
        
        $dto = new ProductoDTO(
            nombre: $producto->nombre,
            precio: $nuevoPrecio,
            stock: $producto->stock,
            activo: $producto->activo,
        );

        return $this->actualizarProducto($producto, $dto);
    }
}
@@endphp</code></pre>
        </div>

        <div class="warning-box">
            <strong>⚠️ Cuándo NO usar Services:</strong>
            <ul>
                <li>Para CRUDs simples</li>
                <li>Cuando una Action es suficiente</li>
                <li>No agregues complejidad innecesaria</li>
            </ul>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
