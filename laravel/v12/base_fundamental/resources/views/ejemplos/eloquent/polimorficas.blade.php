@extends('ejemplos.eloquent.layout')
@section('title', 'Relaciones Polimórficas')
@section('content')
<h1>🔄 Relaciones Polimórficas</h1>
<p class="subtitle">Una tabla que se relaciona con múltiples modelos</p>

<div class="card">
    <h2>¿Qué son las relaciones polimórficas?</h2>
    <p>Permiten que un modelo pertenezca a más de un tipo de modelo usando una sola relación.</p>
    <p>Ejemplo: Una tabla <code>imagenes</code> que puede pertenecer a <code>productos</code> o <code>categorias</code>.</p>
    
    <h3>Estructura de la tabla:</h3>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>imageable_type</th>
                <th>imageable_id</th>
                <th>url</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>App\Models\Producto</td>
                <td>5</td>
                <td>productos/5/imagen-1.jpg</td>
            </tr>
            <tr>
                <td>2</td>
                <td>App\Models\Categoria</td>
                <td>1</td>
                <td>categorias/electronica.jpg</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Productos con sus imágenes</h2>
    @foreach($productos as $producto)
        <div style="margin: 16px 0; padding: 16px; background: #f9fafb; border-radius: 4px;">
            <strong>{{ $producto->nombre }}</strong> ({{ $producto->imagenes->count() }} imágenes)
            <ul>
                @foreach($producto->imagenes as $imagen)
                    <li>{{ $imagen->nombre }} - <code>{{ $imagen->url }}</code></li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

<div class="card">
    <h2>Categorías con sus imágenes</h2>
    @foreach($categorias as $categoria)
        <div style="margin: 16px 0; padding: 16px; background: #f9fafb; border-radius: 4px;">
            <strong>{{ $categoria->nombre }}</strong> ({{ $categoria->imagenes->count() }} imágenes)
            <ul>
                @foreach($categoria->imagenes as $imagen)
                    <li>{{ $imagen->nombre }} - <code>{{ $imagen->url }}</code></li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

<div class="card">
    <h2>Todas las imágenes con su modelo padre</h2>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Tipo de Modelo</th>
                <th>Modelo Padre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($imagenes as $imagen)
            <tr>
                <td>{{ $imagen->nombre }}</td>
                <td><code>{{ class_basename($imagen->imageable_type) }}</code></td>
                <td>
                    @if($imagen->imageable)
                        {{ $imagen->imageable->nombre }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Código del modelo</h2>
    <pre><code>// En Producto.php
public function imagenes(): MorphMany
{
    return $this->morphMany(Imagen::class, 'imageable')
           ->orderBy('orden');
}

// En Categoria.php
public function imagenes(): MorphMany
{
    return $this->morphMany(Imagen::class, 'imageable');
}

// En Imagen.php
public function imageable(): MorphTo
{
    return $this->morphTo();
}

// Uso:
$producto->imagenes; // Obtener imágenes del producto
$categoria->imagenes; // Obtener imágenes de la categoría
$imagen->imageable; // Obtener el modelo padre (Producto o Categoria)</code></pre>
</div>

<div class="card">
    <h2>Migración</h2>
    <pre><code>Schema::create('imagenes', function (Blueprint $table) {
    $table->id();
    $table->morphs('imageable'); // Crea imageable_id e imageable_type
    $table->string('url');
    $table->string('nombre')->nullable();
    $table->integer('orden')->default(0);
    $table->timestamps();
    
    $table->index(['imageable_type', 'imageable_id']);
});</code></pre>
</div>

<div class="card">
    <h2>Crear imágenes polimórficas</h2>
    <pre><code>// Para un producto
$producto->imagenes()->create([
    'url' => 'productos/1/foto.jpg',
    'nombre' => 'Foto principal',
    'orden' => 1,
]);

// Para una categoría
$categoria->imagenes()->create([
    'url' => 'categorias/banner.jpg',
    'nombre' => 'Banner',
    'orden' => 1,
]);</code></pre>
</div>

<div class="card">
    <h2>💡 Conceptos Clave</h2>
    <ul>
        <li><code>morphMany()</code> - Relación uno a muchos polimórfica</li>
        <li><code>morphTo()</code> - Relación inversa polimórfica</li>
        <li><code>morphs()</code> - Crea columnas _type y _id en migración</li>
        <li>Útil para: comentarios, likes, imágenes, tags compartidos</li>
        <li>Evita duplicar tablas para cada modelo</li>
        <li>Siempre indexar las columnas polimórficas</li>
    </ul>
</div>
@endsection
