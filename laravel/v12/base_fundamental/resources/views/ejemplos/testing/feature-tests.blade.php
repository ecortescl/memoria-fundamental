<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Feature Tests</title>
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
        <h1>🌐 Feature Tests</h1>
        <p class="subtitle">Tests de integración que prueban flujos completos</p>

        <div class="card">
            <h2>Test de CRUD Completo</h2>
            <pre><code>test('puede crear producto', function () {
    $response = $this->post('/productos', [
        'nombre' => 'Laptop',
        'precio' => 1000,
        'stock' => 10,
    ]);
    
    $response->assertRedirect('/productos');
    $this->assertDatabaseHas('productos', ['nombre' => 'Laptop']);
});

test('puede actualizar producto', function () {
    $producto = Producto::factory()->create();
    
    $response = $this->put("/productos/{$producto->id}", [
        'nombre' => 'Laptop Pro',
        'precio' => 1500,
    ]);
    
    $response->assertRedirect();
    expect($producto->fresh()->nombre)->toBe('Laptop Pro');
});

test('puede eliminar producto', function () {
    $producto = Producto::factory()->create();
    
    $response = $this->delete("/productos/{$producto->id}");
    
    $response->assertRedirect();
    $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
});</code></pre>
        </div>

        <div class="card">
            <h2>Assertions Comunes</h2>
            <pre><code>// Status
$response->assertStatus(200);
$response->assertOk();
$response->assertCreated();
$response->assertNotFound();

// Redirects
$response->assertRedirect('/productos');
$response->assertRedirectToRoute('productos.index');

// Views
$response->assertViewIs('productos.index');
$response->assertViewHas('productos');

// Database
$this->assertDatabaseHas('productos', ['nombre' => 'Laptop']);
$this->assertDatabaseMissing('productos', ['id' => 999]);</code></pre>
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
