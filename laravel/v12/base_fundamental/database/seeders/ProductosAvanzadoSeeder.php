<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosAvanzadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        // Crear un producto específico con datos personalizados
        Producto::factory()->create([
            'nombre' => 'iPhone 15 Pro Max',
            'descripcion' => 'El último modelo de Apple con chip A17 Pro',
            'precio' => 1299.99,
            'stock' => 50,
            'activo' => true,
        ]);
    }
}
