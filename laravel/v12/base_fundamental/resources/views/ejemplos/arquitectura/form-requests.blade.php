<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Form Requests</title>
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
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ Form Requests</h1>
        <p class="subtitle">Encapsula validación y autorización fuera del controller</p>

        <div class="card">
            <h2>¿Qué son los Form Requests?</h2>
            <p>Clases dedicadas que encapsulan validación, autorización y preparación de datos.</p>
        </div>

        <div class="card">
            <h2>Crear un Form Request</h2>
            <pre><code>php artisan make:request StoreProductoRequest</code></pre>
        </div>

        <div class="card">
            <h2>Ejemplo: StoreProductoRequest</h2>
            <pre><code>@@php
class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Producto::class);
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'precio.min' => 'El precio debe ser mayor a 0',
        ];
    }

    public function toDTO(): ProductoDTO
    {
        return ProductoDTO::fromArray($this->validated());
    }
}
@@endphp</code></pre>
        </div>

        <div class="card">
            <h2>Uso en Controller</h2>
            <pre><code>@@php
public function store(StoreProductoRequest $request)
{
    // ✅ Validación automática
    // ✅ Autorización automática
    
    $producto = $this->service->crearProducto($request->toDTO());
    
    return redirect()->route('productos.index');
}
@@endphp</code></pre>
        </div>

        <div class="info-box">
            <strong>💡 Flujo Automático:</strong>
            <ol>
                <li>Laravel inyecta el Form Request</li>
                <li>Ejecuta <code>authorize()</code> - Si falla: 403</li>
                <li>Ejecuta <code>rules()</code> - Si falla: redirect con errores</li>
                <li>Si todo OK, ejecuta el método del controller</li>
            </ol>
        </div>

        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
