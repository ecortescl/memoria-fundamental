@extends('ejemplos.eloquent.layout')
@section('title', 'Pivot Personalizado')
@section('content')
<h1>⚙️ Pivot Personalizado</h1>
<p class="subtitle">Agrega lógica y datos extra a tablas intermedias</p>

<div class="card">
    <h2>¿Qué es un Pivot Personalizado?</h2>
    <p>En relaciones muchos a muchos, puedes crear un modelo para la tabla intermedia y agregar campos y métodos personalizados.</p>
</div>

<div class="card">
    <h2>Productos con Etiquetas (con datos pivot)</h2>
    @foreach($productos as $producto)
        <div style="margin: 20px 0; padding: 20px; background: #f9fafb; border-radius: 4px;">
            <h3>{{ $producto->nombre }}</h3>
            <p style="color: #6b7280; margin: 8px 0;">{{ $producto->precio_formateado }}</p>
            
            <strong>Etiquetas:</strong>
            <table style="margin-top: 12px;">
                <thead>
                    <tr>
                        <th>Etiqueta</th>
                        <th>Orden</th>
                        <th>Notas</th>
                        <th>Fecha Asignación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producto->etiquetas as $etiqueta)
                    <tr>
                        <td>
                            <span style="background: {{ $etiqueta->color }}20; color: {{ $etiqueta->color }}; padding: 4px 8px; border-radius: 3px;">
                                {{ $etiqueta->nombre }}
                            </span>
                        </td>
                        <td>{{ $etiqueta->pivot->orden }}</td>
                        <td>{{ $etiqueta->pivot->notas ?? '-' }}</td>
                        <td>{{ $etiqueta->pivot->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<div class="card">
    <h2>Código del Modelo Pivot</h2>
    <pre><code>// ProductoEtiqueta.php (Modelo Pivot)
class ProductoEtiqueta extends Pivot
{
    protected $table = 'producto_etiqueta';
    
    protected $fillable = [
        'producto_id',
        'etiqueta_id',
        'orden',
        'notas',
    ];
    
    // Métodos personalizados
    public function esDestacado(): bool
    {
        return $this->orden === 1;
    }
    
    public function tieneNotas(): bool
    {
        return !empty($this->notas);
    }
}</code></pre>
</div>

<div class="card">
    <h2>Uso en el Modelo</h2>
    <pre><code>// En Producto.php
public function etiquetas(): BelongsToMany
{
    return $this->belongsToMany(Etiqueta::class, 'producto_etiqueta')
        ->using(ProductoEtiqueta::class) // Usar modelo pivot personalizado
        ->withPivot(['orden', 'notas']) // Campos adicionales
        ->withTimestamps() // Incluir created_at y updated_at
        ->orderByPivot('orden'); // Ordenar por campo pivot
}

// Acceder a datos pivot:
$producto->etiquetas->first()->pivot->orden;
$producto->etiquetas->first()->pivot->notas;
$producto->etiquetas->first()->pivot->esDestacado();</code></pre>
</div>

<div class="card">
    <h2>Asociar con datos pivot</h2>
    <pre><code>// Asociar etiqueta con datos pivot personalizados
$producto->etiquetas()->attach($etiquetaId, [
    'orden' => 1,
    'notas' => 'Etiqueta principal'
]);

// Actualizar datos pivot
$producto->etiquetas()->updateExistingPivot($etiquetaId, [
    'orden' => 2,
    'notas' => 'Actualizado'
]);

// Sincronizar con datos pivot
$producto->etiquetas()->sync([
    1 => ['orden' => 1, 'notas' => 'Primera'],
    2 => ['orden' => 2, 'notas' => 'Segunda'],
]);</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>using()</code> - Especifica el modelo pivot personalizado</li>
        <li><code>withPivot()</code> - Incluye campos adicionales del pivot</li>
        <li><code>withTimestamps()</code> - Incluye created_at y updated_at</li>
        <li><code>orderByPivot()</code> - Ordena por campo del pivot</li>
        <li><code>$model->pivot</code> - Accede a los datos del pivot</li>
        <li>Puedes agregar métodos y lógica al modelo pivot</li>
    </ul>
</div>
@endsection
