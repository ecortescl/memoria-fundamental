<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1100px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h2 { color: #1f2937; font-size: 24px; font-weight: 600; margin-bottom: 16px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
        .stat-card { background: #f9fafb; padding: 20px; border-radius: 4px; text-align: center; border-left: 4px solid #FF2D20; }
        .stat-number { font-size: 32px; font-weight: 600; color: #FF2D20; }
        .stat-label { color: #6b7280; margin-top: 8px; font-size: 14px; }
        pre { background: #1f2937; color: #10b981; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Services (Servicios)</h1>
        
        <div class="card">
            <h2>¿Qué es un Service?</h2>
            <p>Un Service es una clase que contiene la lógica de negocio de tu aplicación. Separa la lógica compleja del controlador, haciendo el código más limpio, reutilizable y testeable.</p>
        </div>
        
        <div class="card">
            <h2>📊 Estadísticas de Productos</h2>
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $estadisticas['total_productos'] }}</div>
                    <div class="stat-label">Total Productos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $estadisticas['productos_activos'] }}</div>
                    <div class="stat-label">Productos Activos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $estadisticas['productos_sin_stock'] }}</div>
                    <div class="stat-label">Sin Stock</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${{ number_format($estadisticas['precio_promedio'], 2) }}</div>
                    <div class="stat-label">Precio Promedio</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $estadisticas['stock_total'] }}</div>
                    <div class="stat-label">Stock Total</div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h2>Código del Service:</h2>
            <pre>// app/Services/ProductoService.php
public function obtenerEstadisticas()
{
    return [
        'total_productos' => Producto::count(),
        'productos_activos' => Producto::where('activo', true)->count(),
        'productos_sin_stock' => Producto::where('stock', 0)->count(),
        'precio_promedio' => Producto::avg('precio'),
        'stock_total' => Producto::sum('stock'),
    ];
}</pre>
        </div>
        
        <div class="card">
            <h2>Uso en el Controlador:</h2>
            <pre>// Inyección de dependencias en el constructor
public function __construct(ProductoService $productoService)
{
    $this->productoService = $productoService;
}

// Usar el servicio
public function estadisticas()
{
    $estadisticas = $this->productoService->obtenerEstadisticas();
    return view('ejemplos.servicios.estadisticas', compact('estadisticas'));
}</pre>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos de Services:</h3>
            <ul>
                <li>Services contienen lógica de negocio reutilizable</li>
                <li>Se inyectan en controladores mediante el constructor</li>
                <li>Laravel resuelve dependencias automáticamente (Service Container)</li>
                <li>Mantienen los controladores delgados y enfocados</li>
                <li>Facilitan testing y mantenimiento del código</li>
                <li>Pueden ser usados en múltiples controladores</li>
            </ul>
        </div>
        
        <div class="card">
            <h3>Otros ejemplos de Services:</h3>
            <ul>
                <li><a href="/ejemplos/servicios/stock-bajo">Ver productos con stock bajo</a></li>
                <li><a href="/ejemplos/servicios/buscar?q=producto">Buscar productos</a></li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
