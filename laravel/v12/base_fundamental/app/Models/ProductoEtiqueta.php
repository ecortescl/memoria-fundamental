<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Modelo Pivot Personalizado
 * Permite agregar lógica y relaciones a la tabla intermedia
 */
class ProductoEtiqueta extends Pivot
{
    protected $table = 'producto_etiqueta';

    protected $fillable = [
        'producto_id',
        'etiqueta_id',
        'orden',
        'notas',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    // Puedes agregar métodos personalizados al pivot
    public function esDestacado(): bool
    {
        return $this->orden === 1;
    }

    public function tieneNotas(): bool
    {
        return !empty($this->notas);
    }
}
