<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    /**
     * Define el estado por defecto del modelo.
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'descripcion' => fake()->sentence(10),
            'precio' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'activo' => fake()->boolean(80), // 80% activos
        ];
    }

    /**
     * Estado: producto sin stock
     */
    public function sinStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    /**
     * Estado: producto inactivo
     */
    public function inactivo(): static
    {
        return $this->state(fn (array $attributes) => [
            'activo' => false,
        ]);
    }

    /**
     * Estado: producto premium (precio alto)
     */
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'precio' => fake()->randomFloat(2, 500, 2000),
        ]);
    }
}
