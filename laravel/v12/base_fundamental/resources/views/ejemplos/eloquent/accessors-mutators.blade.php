@extends('ejemplos.eloquent.layout')
@section('title', 'Accessors y Mutators')
@section('content')
<h1>✨ Accessors y Mutators Modernos</h1>
<p class="subtitle">Transforma datos al leer y escribir (sintaxis Laravel 9+)</p>

<div class="card">
    <h2>¿Qué son Accessors y Mutators?</h2>
    <p><strong>Accessors:</strong> Transforman datos cuando los lees del modelo.</p>
    <p><strong>Mutators:</strong> Transforman datos antes de guardarlos en la base de datos.</p>
</div>

<div class="card">
    <h2>Ejemplos en Acción</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Original</th>
                <th>Precio Formateado</th>
                <th>Estado Stock</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>
                    <strong>{{ $producto->nombre }}</strong><br>
                    <small style="color: #6b7280;">Formateado: {{ $producto->nombre_formateado }}</small>
                </td>
                <td>{{ $producto->precio }}</td>
                <td><strong>{{ $producto->precio_formateado }}</strong></td>
                <td>
                    @if($producto->estado_stock === 'Sin stock')
                        <span style="color: #ef4444;">{{ $producto->estado_stock }}</span>
                    @elseif($producto->estado_stock === 'Stock bajo')
                        <span style="color: #f59e0b;">{{ $producto->estado_stock }}</span>
                    @else
                        <span style="color: #10b981;">{{ $producto->estado_stock }}</span>
                    @endif
                </td>
                <td>{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Código de Accessors (Sintaxis Moderna)</h2>
    <pre><code>// En Producto.php

// Accessor: Nombre en mayúsculas
protected function nombreFormateado(): Attribute
{
    return Attribute::make(
        get: fn (mixed $value, array $attributes) => strtoupper($attributes['nombre']),
    );
}

// Accessor: Precio con formato
protected function precioFormateado(): Attribute
{
    return Attribute::make(
        get: fn () => '$' . number_format($this->precio, 2),
    );
}

// Accessor: Estado del stock calculado
protected function estadoStock(): Attribute
{
    return Attribute::make(
        get: function () {
            if ($this->stock === 0) return 'Sin stock';
            if ($this->stock < 10) return 'Stock bajo';
            return 'Disponible';
        },
    );
}

// Uso:
$producto->nombre_formateado; // Automático
$producto->precio_formateado;
$producto->estado_stock;</code></pre>
</div>

<div class="card">
    <h2>Código de Mutators (Sintaxis Moderna)</h2>
    <pre><code>// Mutator: Precio siempre positivo
protected function precio(): Attribute
{
    return Attribute::make(
        get: fn (string $value) => (float) $value,
        set: fn (float $value) => abs($value), // Siempre positivo
    );
}

// Mutator: Nombre capitalizado y limpio
protected function nombre(): Attribute
{
    return Attribute::make(
        set: fn (string $value) => ucfirst(trim($value)),
    );
}

// Uso al guardar:
$producto->precio = -100; // Se guarda como 100
$producto->nombre = '  laptop  '; // Se guarda como 'Laptop'
$producto->save();</code></pre>
</div>

<div class="card">
    <h2>Comparación: Sintaxis Antigua vs Moderna</h2>
    
    <h3>❌ Sintaxis Antigua (Laravel 8 y anteriores)</h3>
    <pre><code>// Accessor antiguo
public function getNombreFormateadoAttribute()
{
    return strtoupper($this->nombre);
}

// Mutator antiguo
public function setPrecioAttribute($value)
{
    $this->attributes['precio'] = abs($value);
}</code></pre>
    
    <h3>✅ Sintaxis Moderna (Laravel 9+)</h3>
    <pre><code>// Accessor y Mutator en uno
protected function precio(): Attribute
{
    return Attribute::make(
        get: fn (string $value) => (float) $value,
        set: fn (float $value) => abs($value),
    );
}</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>Attribute::make()</code> - Define accessor y/o mutator</li>
        <li><code>get:</code> - Transforma al leer (accessor)</li>
        <li><code>set:</code> - Transforma al escribir (mutator)</li>
        <li>Accessors se acceden como propiedades: <code>$model->nombre_formateado</code></li>
        <li>Mutators se ejecutan automáticamente al asignar valores</li>
        <li>Puedes combinar get y set en el mismo método</li>
        <li>Sintaxis moderna es más limpia y type-safe</li>
    </ul>
</div>

<div class="card">
    <h2>Casos de Uso Comunes</h2>
    <ul>
        <li><strong>Formateo:</strong> Precios, fechas, números de teléfono</li>
        <li><strong>Concatenación:</strong> Nombre completo, dirección completa</li>
        <li><strong>Cálculos:</strong> Totales, porcentajes, estados derivados</li>
        <li><strong>Limpieza:</strong> Trim, capitalización, normalización</li>
        <li><strong>Validación:</strong> Valores siempre positivos, rangos válidos</li>
        <li><strong>Encriptación:</strong> Hashear contraseñas, encriptar datos sensibles</li>
    </ul>
</div>
@endsection
