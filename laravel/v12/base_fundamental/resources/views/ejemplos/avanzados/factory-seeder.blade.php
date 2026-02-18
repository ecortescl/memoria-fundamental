<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory y Seeder - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
            padding: 40px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { 
            font-size: 36px;
            font-weight: 600;
            color: #FF2D20;
            margin-bottom: 12px;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin: 32px 0 16px;
        }
        h3 {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin: 24px 0 12px;
        }
        .subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 32px;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 14px;
            color: #FF2D20;
            font-family: 'Courier New', monospace;
        }
        pre {
            background: #1f2937;
            color: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            overflow-x: auto;
            margin: 16px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        pre code {
            background: none;
            color: inherit;
            padding: 0;
        }
        ul {
            margin: 16px 0;
            padding-left: 24px;
        }
        li {
            margin: 8px 0;
        }
        a {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        .highlight {
            background: #fef3c7;
            padding: 16px;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            margin: 16px 0;
        }
        .command {
            background: #1f2937;
            color: #10b981;
            padding: 12px 16px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            margin: 12px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏭 Factory y Seeder</h1>
        <p class="subtitle">Genera datos de prueba de forma automática</p>

        <div class="card">
            <h2>¿Qué es un Factory?</h2>
            <p>Un Factory es una clase que define cómo generar datos falsos para tus modelos. Es útil para testing y desarrollo.</p>
            
            <h3>📁 Archivo: database/factories/ProductoFactory.php</h3>
            <pre><code>&lt;?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'descripcion' => fake()->sentence(10),
            'precio' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'activo' => fake()->boolean(80),
        ];
    }

    // Estado: producto sin stock
    public function sinStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    // Estado: producto inactivo
    public function inactivo(): static
    {
        return $this->state(fn (array $attributes) => [
            'activo' => false,
        ]);
    }

    // Estado: producto premium
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'precio' => fake()->randomFloat(2, 500, 2000),
        ]);
    }
}</code></pre>
        </div>

        <div class="card">
            <h2>¿Qué es un Seeder?</h2>
            <p>Un Seeder es una clase que puebla tu base de datos con datos iniciales o de prueba usando Factories.</p>
            
            <h3>📁 Archivo: database/seeders/ProductosAvanzadoSeeder.php</h3>
            <pre><code>&lt;?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosAvanzadoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 20 productos aleatorios
        Producto::factory()->count(20)->create();

        // Crear 5 productos sin stock
        Producto::factory()->sinStock()->count(5)->create();

        // Crear 3 productos inactivos
        Producto::factory()->inactivo()->count(3)->create();

        // Crear 5 productos premium
        Producto::factory()->premium()->count(5)->create();

        // Crear un producto específico
        Producto::factory()->create([
            'nombre' => 'iPhone 15 Pro Max',
            'descripcion' => 'El último modelo de Apple',
            'precio' => 1299.99,
            'stock' => 50,
            'activo' => true,
        ]);
    }
}</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Comandos Artisan</h2>
            
            <h3>Crear un Factory:</h3>
            <div class="command">php artisan make:factory ProductoFactory --model=Producto</div>
            
            <h3>Crear un Seeder:</h3>
            <div class="command">php artisan make:seeder ProductosAvanzadoSeeder</div>
            
            <h3>Ejecutar Seeders:</h3>
            <div class="command">php artisan db:seed --class=ProductosAvanzadoSeeder</div>
            
            <h3>Ejecutar todos los Seeders:</h3>
            <div class="command">php artisan db:seed</div>
            
            <h3>Refrescar base de datos y ejecutar seeders:</h3>
            <div class="command">php artisan migrate:fresh --seed</div>
        </div>

        <div class="card">
            <h2>💡 Conceptos Clave</h2>
            <ul>
                <li><code>fake()</code> - Helper global para generar datos falsos usando Faker</li>
                <li><code>factory()->count(N)</code> - Crea N instancias del modelo</li>
                <li><code>factory()->create()</code> - Crea y guarda en la base de datos</li>
                <li><code>factory()->make()</code> - Crea instancia sin guardar</li>
                <li><code>state()</code> - Define variaciones del factory (estados)</li>
                <li><code>Seeder</code> - Clase para poblar la base de datos</li>
                <li><code>DatabaseSeeder</code> - Seeder principal que llama a otros</li>
            </ul>
        </div>

        <div class="highlight">
            <strong>💡 Tip:</strong> Los Factories son esenciales para testing. Te permiten crear datos de prueba rápidamente sin escribir SQL manualmente.
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
