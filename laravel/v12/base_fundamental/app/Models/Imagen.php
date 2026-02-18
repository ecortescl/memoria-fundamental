<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Imagen extends Model
{
    protected $table = 'imagenes';

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'url',
        'nombre',
        'orden',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    // Relación polimórfica inversa
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    // Accessor moderno
    protected function urlCompleta(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => url('storage/' . $this->url),
        );
    }
}
