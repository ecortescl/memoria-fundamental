<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TDD</title>
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
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 TDD (Test-Driven Development)</h1>
        <p class="subtitle">Escribe tests primero</p>

        <div class="card">
            <h2>Ciclo Red-Green-Refactor</h2>
            <ul>
                <li><strong>Red:</strong> Escribe un test que falle</li>
                <li><strong>Green:</strong> Escribe el código mínimo para que pase</li>
                <li><strong>Refactor:</strong> Mejora el código manteniendo tests verdes</li>
            </ul>
        </div>

        <div class="card">
            <h2>Ejemplo TDD</h2>
            <pre><code>// 1. RED: Test que falla
test('calcula descuento correctamente', function () {
    $producto = new Producto(['precio' => 1000]);
    expect($producto->aplicarDescuento(10))->toBe(900.0);
});

// 2. GREEN: Código mínimo
class Producto {
    public function aplicarDescuento($porcentaje) {
        return $this->precio * (1 - $porcentaje / 100);
    }
}

// 3. REFACTOR: Mejorar
class Producto {
    public function aplicarDescuento(float $porcentaje): float
    {
        if ($porcentaje < 0 || $porcentaje > 100) {
            throw new InvalidArgumentException();
        }
        return $this->precio * (1 - $porcentaje / 100);
    }
}</code></pre>
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
