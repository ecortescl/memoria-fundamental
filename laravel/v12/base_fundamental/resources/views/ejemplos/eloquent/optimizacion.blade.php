@extends('ejemplos.eloquent.layout')
@section('title', 'Optimización e Indexación')
@section('content')
<h1>⚡ Optimización e Indexación</h1>
<p class="subtitle">Mejora el rendimiento de tus queries</p>

<div class="card">
    <h2>Índices en la Tabla Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Índice</th>
                <th>Único</th>
                <th>Origen</th>
            </tr>
        </thead>
        <tbody>
            @forelse($indices as $indice)
            <tr>
                <td><code>{{ $indice->name }}</code></td>
                <td>{{ $indice->unique ? '✓ Sí' : '✗ No' }}</td>
                <td>{{ $indice->origin }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No se pudieron cargar los índices</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Query SQL Generada</h2>
    <pre><code>{{ $sql }}</code></pre>
    
    <h3>Bindings:</h3>
    <pre><code>{{ json_encode($bindings, JSON_PRETTY_PRINT) }}</code></pre>
</div>

<div class="card">
    <h2>Comparación de Performance</h2>
    <table>
        <thead>
            <tr>
                <th>Query</th>
                <th>Tiempo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sin optimizar (vistas > 100)</td>
                <td><strong>{{ number_format($tiempoSinOptimizar, 3) }}ms</strong></td>
            </tr>
            <tr>
                <td>Optimizada (activo + stock con índices)</td>
                <td><strong style="color: #10b981;">{{ number_format($tiempoOptimizado, 3) }}ms</strong></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Cómo Agregar Índices en Migraciones</h2>
    <pre><code>Schema::table('productos', function (Blueprint $table) {
    // Índice simple
    $table->index('categoria_id');
    $table->index('activo');
    $table->index('stock');
    $table->index('vistas');
    
    // Índice compuesto (múltiples columnas)
    $table->index(['activo', 'stock']);
    
    // Índice único
    $table->unique('slug');
    
    // Índice con nombre personalizado
    $table->index('email', 'idx_usuarios_email');
    
    // Foreign key (crea índice automáticamente)
    $table->foreignId('categoria_id')
          ->constrained('categorias')
          ->onDelete('cascade');
});</code></pre>
</div>

<div class="card">
    <h2>Best Practices de Optimización</h2>
    
    <h3>✅ Hacer:</h3>
    <ul>
        <li>Indexar columnas usadas en WHERE, JOIN, ORDER BY</li>
        <li>Usar Eager Loading para evitar N+1</li>
        <li>Seleccionar solo columnas necesarias: <code>select('id', 'nombre')</code></li>
        <li>Usar <code>chunk()</code> para procesar grandes cantidades de datos</li>
        <li>Cachear queries frecuentes</li>
        <li>Usar <code>exists()</code> en lugar de <code>count() > 0</code></li>
    </ul>
    
    <h3>❌ Evitar:</h3>
    <ul>
        <li>Queries dentro de loops (problema N+1)</li>
        <li>Cargar relaciones que no usarás</li>
        <li>Usar <code>all()</code> en tablas grandes</li>
        <li>Funciones en WHERE: <code>WHERE YEAR(created_at) = 2024</code></li>
        <li>Demasiados índices (ralentizan INSERT/UPDATE)</li>
    </ul>
</div>

<div class="card">
    <h2>Técnicas Avanzadas</h2>
    
    <h3>1. Lazy Loading vs Eager Loading</h3>
    <pre><code>// ❌ Lazy Loading (N+1)
$productos = Producto::all();
foreach ($productos as $p) {
    echo $p->categoria->nombre; // +1 query
}

// ✅ Eager Loading
$productos = Producto::with('categoria')->all();
foreach ($productos as $p) {
    echo $p->categoria->nombre; // Sin queries adicionales
}</code></pre>
    
    <h3>2. Chunk para Grandes Volúmenes</h3>
    <pre><code>// Procesa 100 registros a la vez
Producto::chunk(100, function ($productos) {
    foreach ($productos as $producto) {
        // Procesar producto
    }
});</code></pre>
    
    <h3>3. Exists vs Count</h3>
    <pre><code>// ❌ Menos eficiente
if (Producto::where('activo', true)->count() > 0) { }

// ✅ Más eficiente
if (Producto::where('activo', true)->exists()) { }</code></pre>
    
    <h3>4. Select Específico</h3>
    <pre><code>// ❌ Carga todas las columnas
$productos = Producto::all();

// ✅ Solo columnas necesarias
$productos = Producto::select('id', 'nombre', 'precio')->get();</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>index()</code> - Crea índice para búsquedas rápidas</li>
        <li><code>unique()</code> - Índice único (no permite duplicados)</li>
        <li>Índices mejoran SELECT pero ralentizan INSERT/UPDATE</li>
        <li>Indexar foreign keys siempre</li>
        <li>Usar EXPLAIN para analizar queries</li>
        <li>Laravel Debugbar muestra todas las queries</li>
        <li>Telescope para monitoreo en producción</li>
    </ul>
</div>
@endsection
