<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'activa',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    // Relación uno a muchos
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    // Relación polimórfica
    public function imagenes(): MorphMany
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

    // Scope global - solo categorías activas por defecto
    protected static function booted(): void
    {
        static::addGlobalScope('activa', function (Builder $query) {
            $query->where('activa', true);
        });
    }

    // Scope local
    public function scopeConProductos(Builder $query): void
    {
        $query->has('productos');
    }

    // Scope local con parámetro
    public function scopeConMinimoProductos(Builder $query, int $minimo): void
    {
        $query->has('productos', '>=', $minimo);
    }

    // Accessor moderno (Laravel 9+)
    protected function nombreCompleto(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => strtoupper($this->nombre) . ' (' . $this->productos()->count() . ' productos)',
        );
    }
}
