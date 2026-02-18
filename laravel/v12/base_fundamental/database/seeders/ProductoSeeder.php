<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Laptop Dell XPS 13',
                'descripcion' => 'Laptop ultradelgada con procesador Intel i7',
                'precio' => 1299.99,
                'stock' => 15,
                'activo' => true,
            ],
            [
                'nombre' => 'Mouse Logitech MX Master',
                'descripcion' => 'Mouse inalámbrico ergonómico',
                'precio' => 99.99,
                'stock' => 50,
                'activo' => true,
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'descripcion' => 'Teclado mecánico con iluminación RGB',
                'precio' => 149.99,
                'stock' => 3,
                'activo' => true,
            ],
            [
                'nombre' => 'Monitor 4K 27"',
                'descripcion' => 'Monitor 4K UHD de 27 pulgadas',
                'precio' => 399.99,
                'stock' => 8,
                'activo' => true,
            ],
            [
                'nombre' => 'Webcam HD',
                'descripcion' => 'Cámara web Full HD 1080p',
                'precio' => 79.99,
                'stock' => 0,
                'activo' => false,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
