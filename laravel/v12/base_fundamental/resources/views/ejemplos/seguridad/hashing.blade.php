<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hashing</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .demo { background: #f3f4f6; padding: 16px; border-radius: 4px; margin: 16px 0; word-break: break-all; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; padding: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>🔐 Hashing de Contraseñas</h1>

        <div class="card">
            <h2>📊 Ejemplo en vivo</h2>
            <div class="demo">
                <strong>Password original:</strong> {{ $password }}<br>
                <strong>Hash (Bcrypt):</strong> {{ $hashed }}<br>
                <strong>Verificación:</strong> {{ $verificado ? '✅ Correcto' : '❌ Incorrecto' }}
            </div>
        </div>

        <div class="card">
            <h2>✅ Crear hash</h2>
            <pre><code>use Illuminate\Support\Facades\Hash;

// Crear hash
$hashedPassword = Hash::make('mi-password');

// En el registro de usuario
$user = User::create([
    'nombre' => $request->nombre,
    'email' => $request->email,
    'password' => Hash::make($request->password)
]);</code></pre>
        </div>

        <div class="card">
            <h2>✅ Verificar password</h2>
            <pre><code>// En el login
if (Hash::check($request->password, $user->password)) {
    // Password correcto
    auth()->login($user);
} else {
    // Password incorrecto
    return back()->withErrors(['password' => 'Credenciales incorrectas']);
}</code></pre>
        </div>

        <div class="card">
            <h2>🔄 Rehash si es necesario</h2>
            <pre><code>// Verificar si necesita rehash (algoritmo actualizado)
if (Hash::needsRehash($user->password)) {
    $user->password = Hash::make($plainPassword);
    $user->save();
}</code></pre>
        </div>

        <div class="card">
            <h2>❌ NUNCA hagas esto</h2>
            <pre><code>// ❌ Guardar password en texto plano
$user->password = $request->password;

// ❌ Usar MD5 o SHA1
$user->password = md5($request->password);

// ❌ Usar hash sin salt
$user->password = hash('sha256', $request->password);</code></pre>
        </div>

        <div class="success">
            <strong>✅ Buenas prácticas:</strong><br>
            • Laravel usa Bcrypt por defecto (muy seguro)<br>
            • Nunca guardes passwords en texto plano<br>
            • Nunca envíes passwords por email<br>
            • Usa Hash::make() y Hash::check()<br>
            • El hash es unidireccional (no se puede revertir)
        </div>
    </div>
</body>
</html>
