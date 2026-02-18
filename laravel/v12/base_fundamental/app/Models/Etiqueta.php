<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etiqueta extends Model
{
    protected $fillable = [
        'nombre',
        'color',
    ];

    // Relación muchos a muchos con pivot personalizado
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'producto_etiqueta')
            ->using(ProductoEtiqueta::class)
            ->withPivot(['orden', 'notas'])
            ->withTimestamps()
            ->orderByPivot('orden');
    }

    // Accessor moderno
    protected function nombreConColor(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => $this->nombre . ' [' . $this->color . ']',
        );
    }
}
