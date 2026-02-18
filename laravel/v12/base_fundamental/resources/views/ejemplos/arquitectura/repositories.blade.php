<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Repositories</title>
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
        .warning-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin: 20px 0; border-radius: 4px; }
        .danger-box { background: #fee2e2; border-left: 4px solid #ef4444; padding: 16px; margin: 20px 0; border-radius: 4px; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Repositories</h1>
        <p class="subtitle">Abstrae el acceso a datos (úsalos solo cuando sea necesario)</p>

        <div class="warning-box">
            <strong>⚠️ IMPORTANTE:</strong> Los Repositories NO siempre son necesarios. Eloquent ya es un excelente patrón Repository.
        </div>

        <div class="card">
            <h2>Ejemplo: ProductoRepository</h2>
            <pre><code>@@php
class ProductoRepository
{
    public function getAllActivos(): Collection
    {
        return Producto::with(['categoria', 'etiquetas'])
            ->activos()
            ->orderBy('nombre')
            ->get();
    }

    public function buscar(string $termino): Collection
    {
        return Producto::where('nombre', 'like', "%{$termino}%")
            ->with('categoria')
            ->get();
    }

    public function getEstadisticas(): array
    {
        return [
            'total' => Producto::count(),
            'activos' => Producto::activos()->count(),
            'precio_promedio' => Producto::avg('precio'),
        ];
    }
}
@@endphp</code></pre>
        </div>

        <div class="danger-box">
            <strong>❌ Cuándo NO usar:</strong>
            <ul>
                <li>CRUDs simples</li>
                <li>Queries básicas</li>
                <li>Eloquent es suficiente</li>
            </ul>
        </div>

        <div class="warning-box">
            <strong>💡 Regla de Oro:</strong> Si tu Repository solo hace <code>Model::find()</code>, NO lo necesitas.
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
