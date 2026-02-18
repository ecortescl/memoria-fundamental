<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API REST - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
            padding: 40px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { 
            font-size: 36px;
            font-weight: 600;
            color: #FF2D20;
            margin-bottom: 12px;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin: 32px 0 16px;
        }
        h3 {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin: 24px 0 12px;
        }
        .subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 32px;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 14px;
            color: #FF2D20;
            font-family: 'Courier New', monospace;
        }
        pre {
            background: #1f2937;
            color: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            overflow-x: auto;
            margin: 16px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        pre code {
            background: none;
            color: inherit;
            padding: 0;
        }
        ul {
            margin: 16px 0;
            padding-left: 24px;
        }
        li {
            margin: 8px 0;
        }
        a {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        .method {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: 600;
            font-size: 12px;
            margin-right: 8px;
        }
        .get { background: #10b981; color: white; }
        .post { background: #3b82f6; color: white; }
        .put { background: #f59e0b; color: white; }
        .delete { background: #ef4444; color: white; }
        .endpoint {
            background: #f3f4f6;
            padding: 12px;
            border-radius: 4px;
            margin: 12px 0;
            font-family: 'Courier New', monospace;
        }
        .highlight {
            background: #fef3c7;
            padding: 16px;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            margin: 16px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌐 API REST</h1>
        <p class="subtitle">Crea endpoints para consumir desde aplicaciones externas</p>

        <div class="card">
            <h2>¿Qué es una API REST?</h2>
            <p>Una API REST permite que otras aplicaciones (móviles, frontend, etc.) interactúen con tu backend usando HTTP.</p>
            <p>Laravel facilita la creación de APIs con respuestas JSON y validación automática.</p>
        </div>

        <div class="card">
            <h2>📋 Endpoints Disponibles</h2>
            
            <h3><span class="method get">GET</span> Listar todos los productos</h3>
            <div class="endpoint">GET /api/productos</div>
            <pre><code>// Respuesta:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Laptop",
            "precio": 999.99,
            "stock": 10
        }
    ],
    "total": 1
}</code></pre>

            <h3><span class="method post">POST</span> Crear un producto</h3>
            <div class="endpoint">POST /api/productos</div>
            <pre><code>// Body (JSON):
{
    "nombre": "Nuevo Producto",
    "descripcion": "Descripción del producto",
    "precio": 99.99,
    "stock": 50,
    "activo": true
}

// Respuesta:
{
    "success": true,
    "message": "Producto creado exitosamente",
    "data": { ... }
}</code></pre>

            <h3><span class="method get">GET</span> Ver un producto</h3>
            <div class="endpoint">GET /api/productos/{id}</div>

            <h3><span class="method put">PUT</span> Actualizar un producto</h3>
            <div class="endpoint">PUT /api/productos/{id}</div>

            <h3><span class="method delete">DELETE</span> Eliminar un producto</h3>
            <div class="endpoint">DELETE /api/productos/{id}</div>

            <h3><span class="method get">GET</span> Buscar productos</h3>
            <div class="endpoint">GET /api/productos/buscar?q=laptop</div>

            <h3><span class="method get">GET</span> Productos con stock bajo</h3>
            <div class="endpoint">GET /api/productos/stock-bajo?limite=10</div>
        </div>

        <div class="card">
            <h2>📁 Controlador API</h2>
            <h3>app/Http/Controllers/Api/ProductoApiController.php</h3>
            <pre><code>&lt;?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoApiController extends Controller
{
    public function index(): JsonResponse
    {
        $productos = Producto::all();
        
        return response()->json([
            'success' => true,
            'data' => $productos,
            'total' => $productos->count(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
        ]);

        $producto = Producto::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente',
            'data' => $producto,
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $producto,
        ]);
    }
}</code></pre>
        </div>

        <div class="card">
            <h2>🛣️ Rutas API</h2>
            <h3>routes/api.php</h3>
            <pre><code>&lt;?php

use App\Http\Controllers\Api\ProductoApiController;

Route::prefix('productos')->group(function () {
    Route::get('/', [ProductoApiController::class, 'index']);
    Route::post('/', [ProductoApiController::class, 'store']);
    Route::get('/buscar', [ProductoApiController::class, 'buscar']);
    Route::get('/{id}', [ProductoApiController::class, 'show']);
    Route::put('/{id}', [ProductoApiController::class, 'update']);
    Route::delete('/{id}', [ProductoApiController::class, 'destroy']);
});</code></pre>
        </div>

        <div class="card">
            <h2>🧪 Probar la API</h2>
            
            <h3>Con cURL:</h3>
            <pre><code># Listar productos
curl http://localhost:8000/api/productos

# Crear producto
curl -X POST http://localhost:8000/api/productos \
  -H "Content-Type: application/json" \
  -d '{"nombre":"Test","precio":99.99,"stock":10}'

# Ver producto
curl http://localhost:8000/api/productos/1

# Buscar
curl http://localhost:8000/api/productos/buscar?q=laptop</code></pre>

            <h3>Con Postman o Insomnia:</h3>
            <ul>
                <li>Importa la colección de endpoints</li>
                <li>Configura la URL base: <code>http://localhost:8000/api</code></li>
                <li>Prueba cada endpoint con diferentes datos</li>
            </ul>
        </div>

        <div class="card">
            <h2>💡 Conceptos Clave</h2>
            <ul>
                <li><code>response()->json()</code> - Devuelve respuesta JSON</li>
                <li><code>JsonResponse</code> - Tipo de retorno para APIs</li>
                <li>Códigos HTTP: 200 (OK), 201 (Created), 404 (Not Found), 422 (Validation Error)</li>
                <li><code>$request->validate()</code> - Validación automática</li>
                <li>Rutas API están en <code>routes/api.php</code></li>
                <li>Prefijo automático: <code>/api</code></li>
                <li>Middleware: <code>api</code> (rate limiting, JSON responses)</li>
            </ul>
        </div>

        <div class="highlight">
            <strong>💡 Tip:</strong> Las APIs REST son stateless (sin estado). No usan sesiones, por eso son perfectas para aplicaciones móviles y SPAs.
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
