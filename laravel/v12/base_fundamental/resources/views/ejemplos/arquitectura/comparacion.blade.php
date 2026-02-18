<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparación: Malo vs Bueno</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 32px; }
        .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin: 24px 0; }
        .bad, .good { padding: 24px; border-radius: 4px; }
        .bad { background: #fee2e2; border-left: 4px solid #ef4444; }
        .good { background: #d1fae5; border-left: 4px solid #10b981; }
        h2 { font-size: 20px; margin-bottom: 16px; }
        .bad h2 { color: #991b1b; }
        .good h2 { color: #065f46; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 13px; margin: 12px 0; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚖️ Comparación: Malo vs Bueno</h1>

        <div class="comparison">
            <div class="bad">
                <h2>❌ Controller Gordo (Fat Controller)</h2>
                <pre><code>class ProductoController extends Controller
{
    public function store(Request $request)
    {
        // Validación en el controller
        if (empty($request->nombre)) {
            return back()->with('error', 'Nombre requerido');
        }
        
        // Lógica de negocio en el controller
        $precio = abs($request->precio);
        if ($precio > 1000) {
            // Enviar email
            Mail::to('admin@example.com')->send(...);
        }
        
        // Acceso directo a la BD
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $precio;
        $producto->save();
        
        // Más lógica de negocio
        if ($producto->stock < 10) {
            Log::info('Stock bajo');
        }
        
        return redirect()->back();
    }
}</code></pre>
                <p><strong>Problemas:</strong></p>
                <ul>
                    <li>Validación manual propensa a errores</li>
                    <li>Lógica de negocio mezclada</li>
                    <li>Difícil de testear</li>
                    <li>No reutilizable</li>
                    <li>Viola Single Responsibility</li>
                </ul>
            </div>

            <div class="good">
                <h2>✅ Controller Limpio (Thin Controller)</h2>
                <pre><code>class ProductoController extends Controller
{
    public function __construct(
        private ProductoService $service
    ) {
        $this->authorizeResource(Producto::class);
    }
    
    public function store(StoreProductoRequest $request)
    {
        // Validación: Form Request
        // Autorización: Policy
        // Lógica: Service/Action
        
        $producto = $this->service->crearProducto(
            $request->toDTO()
        );
        
        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado');
    }
}</code></pre>
                <p><strong>Ventajas:</strong></p>
                <ul>
                    <li>Validación automática y robusta</li>
                    <li>Lógica separada y reutilizable</li>
                    <li>Fácil de testear</li>
                    <li>Código limpio y legible</li>
                    <li>Sigue SOLID principles</li>
                </ul>
            </div>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
