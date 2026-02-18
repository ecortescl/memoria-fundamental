<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'activo',
        'categoria_id',
        'vistas',
    ];
    
    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
        'stock' => 'integer',
        'vistas' => 'integer',
    ];

    // ========== RELACIONES ==========
    
    // Relación muchos a uno
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación muchos a muchos con pivot personalizado
    public function etiquetas(): BelongsToMany
    {
        return $this->belongsToMany(Etiqueta::class, 'producto_etiqueta')
            ->using(ProductoEtiqueta::class)
            ->withPivot(['orden', 'notas'])
            ->withTimestamps()
            ->orderByPivot('orden');
    }

    // Relación polimórfica
    public function imagenes(): MorphMany
    {
        return $this->morphMany(Imagen::class, 'imageable')->orderBy('orden');
    }

    // ========== ACCESSORS MODERNOS (Laravel 9+) ==========
    
    protected function nombreFormateado(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn (mixed $value, array $attributes) => strtoupper($attributes['nombre']),
        );
    }

    protected function precioFormateado(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => '$' . number_format($this->precio, 2),
        );
    }

    protected function estadoStock(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function () {
                if ($this->stock === 0) return 'Sin stock';
                if ($this->stock < 10) return 'Stock bajo';
                return 'Disponible';
            },
        );
    }

    // ========== MUTATORS MODERNOS ==========
    
    protected function precio(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn (string $value) => (float) $value,
            set: fn (float $value) => abs($value), // Siempre positivo
        );
    }

    protected function nombre(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            set: fn (string $value) => ucfirst(trim($value)), // Capitalizar y limpiar
        );
    }

    // ========== SCOPES LOCALES ==========
    
    public function scopeActivos(Builder $query): void
    {
        $query->where('activo', true);
    }
    
    public function scopeConStock(Builder $query): void
    {
        $query->where('stock', '>', 0);
    }

    public function scopeStockBajo(Builder $query, int $limite = 10): void
    {
        $query->where('stock', '<=', $limite)->where('stock', '>', 0);
    }

    public function scopePopulares(Builder $query, int $minimoVistas = 100): void
    {
        $query->where('vistas', '>=', $minimoVistas)->orderBy('vistas', 'desc');
    }

    public function scopeDeCategoria(Builder $query, int $categoriaId): void
    {
        $query->where('categoria_id', $categoriaId);
    }

    public function scopeConEtiqueta(Builder $query, string $etiquetaNombre): void
    {
        $query->whereHas('etiquetas', function (Builder $q) use ($etiquetaNombre) {
            $q->where('nombre', $etiquetaNombre);
        });
    }

    // Scope con subquery para ordenar por cantidad de imágenes
    public function scopeOrdenadoPorImagenes(Builder $query, string $direccion = 'desc'): void
    {
        $query->withCount('imagenes')->orderBy('imagenes_count', $direccion);
    }

    // ========== MÉTODOS AUXILIARES ==========
    
    public function incrementarVistas(): void
    {
        $this->increment('vistas');
    }

    public function tieneStock(): bool
    {
        return $this->stock > 0;
    }

    public function esPopular(): bool
    {
        return $this->vistas >= 100;
    }
}
