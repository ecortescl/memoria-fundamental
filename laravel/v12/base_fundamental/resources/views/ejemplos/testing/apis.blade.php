<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Testing de APIs</title>
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
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔌 Testing de APIs</h1>
        <p class="subtitle">Prueba endpoints REST</p>

        <div class="card">
            <h2>Test de API REST</h2>
            <pre><code>test('api retorna productos', function () {
    Producto::factory()->count(3)->create();
    
    $response = $this->getJson('/api/productos');
    
    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nombre', 'precio']
            ]
        ])
        ->assertJsonCount(3, 'data');
});

test('api crea producto', function () {
    $response = $this->postJson('/api/productos', [
        'nombre' => 'Laptop',
        'precio' => 1000,
    ]);
    
    $response->assertCreated()
        ->assertJson([
            'nombre' => 'Laptop',
        ]);
});</code></pre>
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
