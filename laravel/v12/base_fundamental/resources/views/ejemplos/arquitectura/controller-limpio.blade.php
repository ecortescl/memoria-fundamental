<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Controllers Limpios</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 28px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin-bottom: 16px; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; font-size: 13px; margin: 16px 0; line-height: 1.5; }
        .info-box { background: #dbeafe; border-left: 4px solid #3b82f6; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0; }
        .bad { background: #fee2e2; border-left: 4px solid #ef4444; padding: 20px; border-radius: 4px; }
        .good { background: #d1fae5; border-left: 4px solid #10b981; padding: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 Controllers Limpios (Thin Controllers)</h1>
        <p class="subtitle">Los controllers deben ser delgados y solo coordinar</p>

        <div class="card">
            <h2>Principio Fundamental</h2>
            <p>Un controller NO debe contener lógica de negocio. Su única responsabilidad es:</p>
            <ul>
                <li>Recibir la petición HTTP</li>
                <li>Delegar a Services/Actions</li>
                <li>Retornar una respuesta</li>
            </ul>
        </div>

        <div class="comparison">
            <div class="bad">
                <h3>❌ Controller Gordo</h3>
                <pre><code>public function store(Request $request)
{
    // Validación manual
    if (empty($request->nombre)) {
        return back()->with('error', 'Error');
    }
    
    // Lógica de negocio
    $precio = abs($request->precio);
    if ($precio > 1000) {
        Mail::to('admin')->send(...);
    }
    
    $producto = new Producto();
    $producto->nombre = $request->nombre;
    $producto->save();
    
    return redirect()->back();
}</code></pre>
            </div>

            <div class="good">
                <h3>✅ Controller Limpio</h3>
                <pre><code>public function store(StoreProductoRequest $request)
{
    $producto = $this->service->crearProducto(
        $request->toDTO()
    );
    
    return redirect()
        ->route('productos.index')
        ->with('success', 'Producto creado');
}</code></pre>
            </div>
        </div>

        <div class="card">
            <h2>Ejemplo Real: ArquitecturaController</h2>
            <pre><code>@@php
namespace App\Http\Controllers;

class ArquitecturaController extends Controller
{
    public function __construct(
        private ProductoService $productoService
    ) {}

    public function store(StoreProductoRequest $request)
    {
        $producto = $this->productoService->crearProducto(
            $request->toDTO()
        );
        
        return redirect()
            ->route('productos.index')
            ->with('success', "Producto creado");
    }
}
@@endphp</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Ventajas del Thin Controller:</strong>
            <ul>
                <li>Fácil de leer y entender</li>
                <li>Lógica reutilizable</li>
                <li>Fácil de testear</li>
                <li>Cumple Single Responsibility</li>
            </ul>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
