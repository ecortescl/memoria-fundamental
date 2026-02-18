@extends('ejemplos.eloquent.layout')
@section('title', 'Scopes')
@section('content')
<h1>🎯 Scopes Locales y Globales</h1>
<p class="subtitle">Reutiliza queries complejas con scopes</p>

<div class="card">
    <h2>Scopes Locales</h2>
    <p>Métodos reutilizables que puedes encadenar en tus queries.</p>
    
    <h3>Productos Activos ({{ $activos->count() }})</h3>
    <pre><code>Producto::activos()->get()</code></pre>
    
    <h3>Productos con Stock ({{ $conStock->count() }})</h3>
    <pre><code>Producto::conStock()->get()</code></pre>
    
    <h3>Productos con Stock Bajo ({{ $stockBajo->count() }})</h3>
    <pre><code>Producto::stockBajo(10)->get()</code></pre>
    
    <h3>Productos Populares ({{ $populares->count() }})</h3>
    <pre><code>Producto::populares(100)->get()</code></pre>
</div>

<div class="card">
    <h2>Combinar Scopes</h2>
    <p>Puedes encadenar múltiples scopes para queries más específicas.</p>
    
    <h3>Activos con Stock ({{ $activosConStock->count() }})</h3>
    <pre><code>Producto::activos()->conStock()->get()</code></pre>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activosConStock->take(5) as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio_formateado }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->estado_stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Scopes con Relaciones</h2>
    <h3>Productos de Electrónica ({{ $electronica->count() }})</h3>
    <pre><code>Producto::deCategoria(1)->with('categoria')->get()</code></pre>
    
    <ul>
        @foreach($electronica as $producto)
            <li>{{ $producto->nombre }} - {{ $producto->categoria->nombre }}</li>
        @endforeach
    </ul>
</div>

<div class="card">
    <h2>Scopes Globales</h2>
    <p>Se aplican automáticamente a todas las queries del modelo.</p>
    
    <h3>Categorías Activas ({{ $categoriasActivas->count() }})</h3>
    <pre><code>Categoria::all() // Solo muestra activas por defecto</code></pre>
    
    <h3>Todas las Categorías ({{ $todasCategorias->count() }})</h3>
    <pre><code>Categoria::withoutGlobalScope('activa')->get()</code></pre>
    
    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todasCategorias as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>
                    @if($categoria->activa)
                        <span style="color: #10b981;">✓ Activa</span>
                    @else
                        <span style="color: #ef4444;">✗ Inactiva</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Código de los Scopes</h2>
    <pre><code>// Scopes Locales en Producto.php
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

// Scope Global en Categoria.php
protected static function booted(): void
{
    static::addGlobalScope('activa', function (Builder $query) {
        $query->where('activa', true);
    });
}</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>scopeNombre()</code> - Define un scope local (se usa como <code>->nombre()</code>)</li>
        <li>Scopes locales son encadenables</li>
        <li>Pueden recibir parámetros</li>
        <li>Scopes globales se aplican automáticamente</li>
        <li><code>withoutGlobalScope()</code> - Desactiva un scope global</li>
        <li><code>withoutGlobalScopes()</code> - Desactiva todos los scopes globales</li>
    </ul>
</div>
@endsection
