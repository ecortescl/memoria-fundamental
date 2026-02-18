<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mass Assignment</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 24px; border-radius: 4px; }
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>📝 Mass Assignment Protection</h1>

        <div class="alert">
            <strong>⚠️ ¿Qué es Mass Assignment?</strong><br>
            Un atacante puede modificar campos que no debería (ej: is_admin, role, precio) enviando datos extra en el request.
        </div>

        <div class="card">
            <h2>❌ Vulnerable</h2>
            <pre><code>// Sin protección
class User extends Model
{
    // Sin $fillable ni $guarded
}

// Controller
$user = User::create($request->all());

// Un atacante envía:
// { "nombre": "Juan", "email": "juan@test.com", "is_admin": true }
// ¡Se convierte en admin!</code></pre>
        </div>

        <div class="card">
            <h2>✅ Protegido con $fillable</h2>
            <pre><code>class User extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'password'
    ];
    
    // is_admin NO está en $fillable, no se puede asignar masivamente
}

$user = User::create($request->only(['nombre', 'email', 'password']));</code></pre>
        </div>

        <div class="card">
            <h2>✅ Protegido con $guarded</h2>
            <pre><code>class User extends Model
{
    protected $guarded = [
        'id',
        'is_admin',
        'role'
    ];
    
    // Todo excepto estos campos se puede asignar
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Asignación manual para campos sensibles</h2>
            <pre><code>$user = User::create($request->only(['nombre', 'email']));

// Asignar manualmente campos sensibles
if (auth()->user()->isAdmin()) {
    $user->is_admin = $request->is_admin;
    $user->save();
}</code></pre>
        </div>

        <div class="success alert">
            <strong>✅ Buenas prácticas:</strong><br>
            • Siempre define $fillable o $guarded<br>
            • Usa $fillable (whitelist) en lugar de $guarded (blacklist)<br>
            • Usa $request->only() o $request->validated()<br>
            • Asigna manualmente campos sensibles<br>
            • Nunca uses $guarded = []
        </div>
    </div>
</body>
</html>
