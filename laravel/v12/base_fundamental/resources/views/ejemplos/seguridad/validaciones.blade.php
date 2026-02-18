<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validaciones Robustas</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>✅ Validaciones Robustas</h1>

        <div class="card">
            <h2>🔧 Validación básica</h2>
            <pre><code>$validated = $request->validate([
    'nombre' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
    'edad' => 'required|integer|min:18|max:120',
    'url' => 'required|url',
    'ip' => 'required|ip',
]);</code></pre>
        </div>

        <div class="card">
            <h2>🛡️ Validaciones de seguridad</h2>
            <pre><code>$validated = $request->validate([
    // Prevenir XSS
    'comentario' => 'required|string|max:1000',
    
    // Validar archivos
    'avatar' => 'required|image|mimes:jpeg,png|max:2048',
    'documento' => 'required|file|mimes:pdf|max:10240',
    
    // Validar URLs
    'website' => 'nullable|url|active_url',
    
    // Validar JSON
    'metadata' => 'required|json',
    
    // Validar UUID
    'uuid' => 'required|uuid',
]);</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Reglas personalizadas</h2>
            <pre><code>use Illuminate\Validation\Rule;

$validated = $request->validate([
    'role' => ['required', Rule::in(['admin', 'user', 'guest'])],
    'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
    'slug' => ['required', 'alpha_dash', Rule::unique('productos')],
]);</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Validación condicional</h2>
            <pre><code>$validated = $request->validate([
    'tipo' => 'required|in:persona,empresa',
    'rut' => 'required_if:tipo,persona',
    'razon_social' => 'required_if:tipo,empresa',
    'descuento' => 'nullable|numeric|min:0|max:100',
    'precio_final' => 'required_with:descuento',
]);</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Sanitización</h2>
            <pre><code>// Limpiar datos antes de guardar
$validated = $request->validate([...]);

$producto = Producto::create([
    'nombre' => strip_tags($validated['nombre']),
    'descripcion' => Str::limit(strip_tags($validated['descripcion']), 500),
    'slug' => Str::slug($validated['nombre']),
    'precio' => round($validated['precio'], 2),
]);</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Form Request</h2>
            <pre><code>// app/Http/Requests/StoreProductoRequest.php
class StoreProductoRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }
    
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'precio.min' => 'El precio debe ser mayor a 0',
        ];
    }
}</code></pre>
        </div>
    </div>
</body>
</html>
