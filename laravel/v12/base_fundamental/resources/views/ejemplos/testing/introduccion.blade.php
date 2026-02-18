<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Introducción a Testing</title>
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
        .success-box { background: #d1fae5; border-left: 4px solid #10b981; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📖 Introducción a Testing</h1>
        <p class="subtitle">Fundamentos de testing en Laravel</p>

        <div class="card">
            <h2>¿Por Qué Testear?</h2>
            <ul>
                <li><strong>Confianza:</strong> Refactoriza sin miedo</li>
                <li><strong>Documentación:</strong> Los tests muestran cómo usar el código</li>
                <li><strong>Debugging:</strong> Encuentra bugs antes de producción</li>
                <li><strong>Diseño:</strong> Código testeable es código bien diseñado</li>
                <li><strong>Profesionalismo:</strong> Es lo que hacen los seniors</li>
            </ul>
        </div>

        <div class="card">
            <h2>Tipos de Tests</h2>
            <h3>1. Unit Tests</h3>
            <p>Prueban una unidad aislada (clase, método):</p>
            <pre><code>// tests/Unit/ProductoDTOTest.php
test('crea DTO desde array', function () {
    $dto = ProductoDTO::fromArray([
        'nombre' => 'Laptop',
        'precio' => 1000,
    ]);
    
    expect($dto->nombre)->toBe('Laptop');
    expect($dto->precio)->toBe(1000.0);
});</code></pre>

            <h3>2. Feature Tests</h3>
            <p>Prueban flujos completos (HTTP, DB, etc.):</p>
            <pre><code>// tests/Feature/ProductoTest.php
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

        <div class="card">
            <h2>Configuración Inicial</h2>
            <pre><code># Ejecutar tests
php artisan test

# Crear test
php artisan make:test ProductoTest
php artisan make:test ProductoDTOTest --unit

# Instalar Pest (opcional)
composer require pestphp/pest --dev --with-all-dependencies
php artisan pest:install</code></pre>
        </div>

        <div class="card">
            <h2>Estructura de un Test</h2>
            <pre><code>@@php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;

class ProductoTest extends TestCase
{
    /** @@test */
    public function puede_listar_productos()
    {
        // Arrange (preparar)
        Producto::factory()->count(3)->create();
        
        // Act (actuar)
        $response = $this->get('/productos');
        
        // Assert (verificar)
        $response->assertStatus(200);
        $response->assertViewHas('productos');
    }
}
@@endphp</code></pre>
        </div>

        <div class="success-box">
            <strong>✅ Patrón AAA:</strong>
            <ul>
                <li><strong>Arrange:</strong> Prepara datos y estado</li>
                <li><strong>Act:</strong> Ejecuta la acción a testear</li>
                <li><strong>Assert:</strong> Verifica el resultado</li>
            </ul>
        </div>

        <div class="card">
            <h2>Base de Datos en Tests</h2>
            <pre><code>@@php
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoTest extends TestCase
{
    use RefreshDatabase; // Resetea DB después de cada test
    
    public function test_crea_producto()
    {
        $producto = Producto::create([
            'nombre' => 'Test',
            'precio' => 100,
        ]);
        
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Test',
        ]);
    }
}
@@endphp</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Tip:</strong> Laravel usa SQLite en memoria para tests por defecto. Es rápido y no afecta tu BD de desarrollo.
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
