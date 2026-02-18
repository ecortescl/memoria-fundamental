<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encriptación</title>
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
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>🔑 Encriptación</h1>

        <div class="card">
            <h2>📊 Ejemplo en vivo</h2>
            <div class="demo">
                <strong>Texto original:</strong> {{ $texto }}<br>
                <strong>Encriptado:</strong> {{ $encriptado }}<br>
                <strong>Desencriptado:</strong> {{ $desencriptado }}
            </div>
        </div>

        <div class="card">
            <h2>✅ Encriptar datos</h2>
            <pre><code>use Illuminate\Support\Facades\Crypt;

// Encriptar string
$encriptado = Crypt::encryptString('Datos sensibles');

// Encriptar array/objeto
$encriptado = Crypt::encrypt(['tarjeta' => '1234-5678']);</code></pre>
        </div>

        <div class="card">
            <h2>✅ Desencriptar datos</h2>
            <pre><code>try {
    $desencriptado = Crypt::decryptString($encriptado);
} catch (DecryptException $e) {
    // Datos corruptos o clave incorrecta
    Log::error('Error al desencriptar: ' . $e->getMessage());
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Uso en modelos</h2>
            <pre><code>class User extends Model
{
    protected $casts = [
        'datos_bancarios' => 'encrypted',
        'tarjeta' => 'encrypted:array'
    ];
}

// Laravel encripta/desencripta automáticamente
$user->datos_bancarios = 'Información sensible';
$user->save();</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Configuración (APP_KEY)</h2>
            <pre><code># .env
APP_KEY=base64:tu-clave-generada

# Generar nueva clave
php artisan key:generate

# ⚠️ Si cambias APP_KEY, no podrás desencriptar datos antiguos</code></pre>
        </div>
    </div>
</body>
</html>
