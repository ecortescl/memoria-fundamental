@extends('ejemplos.eloquent.layout')
@section('title', 'Query Builder Avanzado')
@section('content')
<h1>🔍 Query Builder Avanzado</h1>
<p class="subtitle">Queries complejas con subqueries y agregaciones</p>

<div class="card">
    <h2>Subquery: Productos Premium</h2>
    <p>Productos con precio mayor al promedio: <strong>${{ number_format($precioPromedio, 2) }}</strong></p>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosPremium as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td><strong>{{ $producto->precio_formateado }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <pre><code>$precioPromedio = Producto::avg('precio');
$productosPremium = Producto::where('precio', '>', $precioPromedio)->get();</code></pre>
</div>

<div class="card">
    <h2>Subquery en SELECT: Conteos</h2>
    <p>Productos con conteo de etiquetas e imágenes.</p>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Etiquetas</th>
                <th>Imágenes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosConConteos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->etiquetas_count }}</td>
                <td>{{ $producto->imagenes_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <pre><code>$productos = Producto::select('productos.*')
    ->withCount(['etiquetas', 'imagenes'])
    ->having('etiquetas_count', '>', 0)
    ->get();</code></pre>
</div>

<div class="card">
    <h2>Subquery en WHERE: Categorías Populares</h2>
    <p>Productos de categorías que tienen 2 o más productos.</p>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosCategoriasPopulares as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <pre><code>$productos = Producto::whereHas('categoria', function ($query) {
    $query->has('productos', '>=', 2);
})->with('categoria')->get();</code></pre>
</div>

<div class="card">
    <h2>Agregaciones por Categoría</h2>
    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Total Productos</th>
                <th>Precio Promedio</th>
                <th>Stock Total</th>
                <th>Máx Vistas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estadisticasPorCategoria as $stat)
            <tr>
                <td><strong>{{ $stat->categoria->nombre }}</strong></td>
                <td>{{ $stat->total_productos }}</td>
                <td>${{ number_format($stat->precio_promedio, 2) }}</td>
                <td>{{ $stat->stock_total }}</td>
                <td>{{ $stat->max_vistas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <pre><code>$stats = Producto::select('categoria_id')
    ->selectRaw('COUNT(*) as total_productos')
    ->selectRaw('AVG(precio) as precio_promedio')
    ->selectRaw('SUM(stock) as stock_total')
    ->selectRaw('MAX(vistas) as max_vistas')
    ->groupBy('categoria_id')
    ->with('categoria')
    ->get();</code></pre>
</div>

<div class="card">
    <h2>Window Functions: Ranking por Categoría</h2>
    <p>Productos rankeados por vistas dentro de su categoría.</p>
    
    @foreach($ranking as $categoriaId => $productos)
        @if($productos->first()->categoria)
        <h3>{{ $productos->first()->categoria->nombre }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Producto</th>
                    <th>Vistas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos->take(3) as $producto)
                <tr>
                    <td><strong>#{{ $producto->ranking }}</strong></td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->vistas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    @endforeach
    
    <pre><code>$ranking = Producto::select('productos.*')
    ->selectRaw('RANK() OVER (PARTITION BY categoria_id ORDER BY vistas DESC) as ranking')
    ->with('categoria')
    ->get()
    ->groupBy('categoria_id');</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>avg(), sum(), max(), min(), count()</code> - Funciones de agregación</li>
        <li><code>withCount()</code> - Cuenta relaciones sin cargarlas</li>
        <li><code>whereHas()</code> - Filtra por existencia de relación</li>
        <li><code>has()</code> - Verifica existencia de relación</li>
        <li><code>selectRaw()</code> - SQL crudo en SELECT</li>
        <li><code>groupBy()</code> - Agrupa resultados</li>
        <li><code>having()</code> - Filtra grupos</li>
        <li><code>RANK() OVER()</code> - Window functions (SQLite 3.25+)</li>
    </ul>
</div>
@endsection
