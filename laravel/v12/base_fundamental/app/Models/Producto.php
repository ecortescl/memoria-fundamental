<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Tabla asociada
    protected $table = 'productos';
    
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'activo'
    ];
    
    // Campos que deben ser casteados
    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];
    
    // Accessor: modifica cómo se obtiene un atributo
    public function getNombreFormateadoAttribute()
    {
        return strtoupper($this->nombre);
    }
    
    // Mutator: modifica cómo se guarda un atributo
    public function setPrecioAttribute($value)
    {
        $this->attributes['precio'] = abs($value);
    }
    
    // Scope: consulta reutilizable
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
    
    public function scopeConStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}
