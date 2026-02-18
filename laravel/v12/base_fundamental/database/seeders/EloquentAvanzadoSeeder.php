<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Producto;
use App\Models\Imagen;
use Illuminate\Database\Seeder;

class EloquentAvanzadoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías
        $categorias = [
            ['nombre' => 'Electrónica', 'slug' => 'electronica', 'descripcion' => 'Productos electrónicos', 'activa' => true],
            ['nombre' => 'Ropa', 'slug' => 'ropa', 'descripcion' => 'Ropa y accesorios', 'activa' => true],
            ['nombre' => 'Hogar', 'slug' => 'hogar', 'descripcion' => 'Artículos para el hogar', 'activa' => true],
            ['nombre' => 'Deportes', 'slug' => 'deportes', 'descripcion' => 'Equipamiento deportivo', 'activa' => true],
            ['nombre' => 'Libros', 'slug' => 'libros', 'descripcion' => 'Libros y revistas', 'activa' => false], // Inactiva
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }

        // Crear etiquetas
        $etiquetas = [
            ['nombre' => 'Nuevo', 'color' => '#10b981'],
            ['nombre' => 'Oferta', 'color' => '#ef4444'],
            ['nombre' => 'Popular', 'color' => '#f59e0b'],
            ['nombre' => 'Destacado', 'color' => '#8b5cf6'],
            ['nombre' => 'Envío Gratis', 'color' => '#3b82f6'],
        ];

        foreach ($etiquetas as $etiq) {
            Etiqueta::create($etiq);
        }

        // Crear productos con relaciones
        $productos = [
            [
                'nombre' => 'iPhone 15 Pro',
                'descripcion' => 'Smartphone de última generación',
                'precio' => 1299.99,
                'stock' => 25,
                'activo' => true,
                'categoria_id' => 1,
                'vistas' => 250,
                'etiquetas' => [1, 3, 4], // Nuevo, Popular, Destacado
                'imagenes' => 3,
            ],
            [
                'nombre' => 'MacBook Pro M3',
                'descripcion' => 'Laptop profesional con chip M3',
                'precio' => 2499.99,
                'stock' => 15,
                'activo' => true,
                'categoria_id' => 1,
                'vistas' => 180,
                'etiquetas' => [1, 4],
                'imagenes' => 4,
            ],
            [
                'nombre' => 'Camiseta Nike',
                'descripcion' => 'Camiseta deportiva de algodón',
                'precio' => 29.99,
                'stock' => 100,
                'activo' => true,
                'categoria_id' => 2,
                'vistas' => 50,
                'etiquetas' => [2, 5], // Oferta, Envío Gratis
                'imagenes' => 2,
            ],
            [
                'nombre' => 'Sofá Moderno',
                'descripcion' => 'Sofá de 3 plazas color gris',
                'precio' => 899.99,
                'stock' => 5,
                'activo' => true,
                'categoria_id' => 3,
                'vistas' => 120,
                'etiquetas' => [2],
                'imagenes' => 5,
            ],
            [
                'nombre' => 'Bicicleta Montaña',
                'descripcion' => 'Bicicleta 21 velocidades',
                'precio' => 499.99,
                'stock' => 8,
                'activo' => true,
                'categoria_id' => 4,
                'vistas' => 95,
                'etiquetas' => [3, 5],
                'imagenes' => 3,
            ],
            [
                'nombre' => 'Auriculares Sony',
                'descripcion' => 'Auriculares con cancelación de ruido',
                'precio' => 349.99,
                'stock' => 0, // Sin stock
                'activo' => true,
                'categoria_id' => 1,
                'vistas' => 200,
                'etiquetas' => [3],
                'imagenes' => 2,
            ],
            [
                'nombre' => 'Zapatillas Adidas',
                'descripcion' => 'Zapatillas running ultraboost',
                'precio' => 159.99,
                'stock' => 45,
                'activo' => true,
                'categoria_id' => 4,
                'vistas' => 310,
                'etiquetas' => [1, 3, 5],
                'imagenes' => 4,
            ],
            [
                'nombre' => 'Mesa de Comedor',
                'descripcion' => 'Mesa extensible para 6 personas',
                'precio' => 599.99,
                'stock' => 3,
                'activo' => true,
                'categoria_id' => 3,
                'vistas' => 75,
                'etiquetas' => [2],
                'imagenes' => 3,
            ],
        ];

        foreach ($productos as $prodData) {
            $etiquetasIds = $prodData['etiquetas'];
            $cantidadImagenes = $prodData['imagenes'];
            unset($prodData['etiquetas'], $prodData['imagenes']);

            $producto = Producto::create($prodData);

            // Asociar etiquetas con datos pivot personalizados
            foreach ($etiquetasIds as $index => $etiquetaId) {
                $producto->etiquetas()->attach($etiquetaId, [
                    'orden' => $index + 1,
                    'notas' => $index === 0 ? 'Etiqueta principal' : null,
                ]);
            }

            // Crear imágenes polimórficas
            for ($i = 1; $i <= $cantidadImagenes; $i++) {
                $producto->imagenes()->create([
                    'url' => "productos/{$producto->id}/imagen-{$i}.jpg",
                    'nombre' => "Imagen {$i}",
                    'orden' => $i,
                ]);
            }
        }

        // Crear imágenes para categorías (relación polimórfica)
        $categoria = Categoria::first();
        $categoria->imagenes()->create([
            'url' => 'categorias/electronica-banner.jpg',
            'nombre' => 'Banner Electrónica',
            'orden' => 1,
        ]);

        $this->command->info('✅ Datos de Eloquent Avanzado creados exitosamente');
        $this->command->info('📊 Categorías: ' . Categoria::withoutGlobalScope('activa')->count());
        $this->command->info('📦 Productos: ' . Producto::count());
        $this->command->info('🏷️  Etiquetas: ' . Etiqueta::count());
        $this->command->info('🖼️  Imágenes: ' . Imagen::count());
    }
}
