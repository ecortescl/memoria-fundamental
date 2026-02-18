<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PHPUnit vs Pest</title>
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
        .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0; }
        .phpunit { background: #e0e7ff; border-left: 4px solid #6366f1; padding: 20px; border-radius: 4px; }
        .pest { background: #d1fae5; border-left: 4px solid #10b981; padding: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚔️ PHPUnit vs Pest</h1>
        <p class="subtitle">Compara las dos herramientas más usadas</p>

        <div class="comparison">
            <div class="phpunit">
                <h3>PHPUnit (Clásico)</h3>
                <pre><code>@@php
class ProductoTest extends TestCase
{
    use RefreshDatabase;
    
    /** @@test */
    public function puede_crear_producto()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Laptop',
            'precio' => 1000,
        ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Laptop',
        ]);
    }
}
@@endphp</code></pre>
            </div>

            <div class="pest">
                <h3>Pest (Moderno)</h3>
                <pre><code>uses(RefreshDatabase::class);

test('puede crear producto', function () {
    $response = $this->post('/productos', [
        'nombre' => 'Laptop',
        'precio' => 1000,
    ]);
    
    $response->assertStatus(201);
    $this->assertDatabaseHas('productos', [
        'nombre' => 'Laptop',
    ]);
});</code></pre>
            </div>
        </div>

        <div class="card">
            <h2>Pest: Sintaxis Moderna</h2>
            <pre><code>// Expectations (más legible)
expect($producto->nombre)->toBe('Laptop');
expect($producto->precio)->toBeGreaterThan(0);
expect($producto->activo)->toBeTrue();

// Higher Order Tests
it('tiene nombre')->expect(fn() => $producto->nombre)->not->toBeEmpty();

// Datasets
it('valida precios', function ($precio) {
    expect($precio)->toBeGreaterThan(0);
})->with([100, 500, 1000]);</code></pre>
        </div>

        <div class="card">
            <h2>¿Cuál Elegir?</h2>
            <ul>
                <li><strong>PHPUnit:</strong> Estándar, más documentación, compatible con todo</li>
                <li><strong>Pest:</strong> Sintaxis moderna, más legible, muy popular ahora</li>
                <li><strong>Recomendación:</strong> Pest para proyectos nuevos, PHPUnit si ya lo usas</li>
            </ul>
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
