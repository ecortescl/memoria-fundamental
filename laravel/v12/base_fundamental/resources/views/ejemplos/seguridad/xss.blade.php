<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Prevention</title>
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
        code { font-family: 'Courier New', monospace; font-size: 14px; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
        .demo { background: #fef3c7; padding: 16px; border-radius: 4px; margin: 16px 0; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>🚫 XSS Prevention</h1>

        <div class="alert">
            <strong>⚠️ ¿Qué es XSS?</strong><br>
            Cross-Site Scripting: inyectar código JavaScript malicioso en tu aplicación para robar datos o ejecutar acciones no autorizadas.
        </div>

        <div class="card">
            <h2>❌ Vulnerable</h2>
            <pre><code>&lt;!-- NUNCA hagas esto --&gt;
&lt;div&gt;
    {!! $comentario !!}  &lt;!-- Sin escapar --&gt;
&lt;/div&gt;

&lt;!-- Si $comentario = '&lt;script&gt;alert("XSS")&lt;/script&gt;' --&gt;
&lt;!-- El script se ejecutará --&gt;</code></pre>
            
            <div class="demo">
                <strong>Ejemplo malo:</strong> {{ $ejemploMalo }}
            </div>
        </div>

        <div class="card">
            <h2>✅ Protegido (Laravel escapa automáticamente)</h2>
            <pre><code>&lt;!-- Laravel escapa automáticamente con {{ }} --&gt;
&lt;div&gt;
    {{ $comentario }}  &lt;!-- Escapado automáticamente --&gt;
&lt;/div&gt;

&lt;!-- El script se muestra como texto, no se ejecuta --&gt;</code></pre>
            
            <div class="demo">
                <strong>Ejemplo bueno:</strong> {{ $ejemploBueno }}
            </div>
        </div>

        <div class="card">
            <h2>🔧 Cuándo usar {!! !!}</h2>
            <pre><code>// Solo cuando confías 100% en el contenido
// Por ejemplo: contenido de administradores

&lt;div&gt;
    {!! $contenidoHTML !!}
&lt;/div&gt;

// Mejor opción: usar un sanitizador
use Illuminate\Support\Str;

$contenidoLimpio = Str::of($contenidoHTML)
    -&gt;stripTags(['p', 'br', 'strong', 'em']);</code></pre>
        </div>

        <div class="card">
            <h2>🛡️ Protección en JavaScript</h2>
            <pre><code>// ❌ Vulnerable
element.innerHTML = userInput;

// ✅ Seguro
element.textContent = userInput;

// En Blade
&lt;script&gt;
    const userData = @@json($user);  // Escapa automáticamente
&lt;/script&gt;</code></pre>
        </div>

        <div class="success alert">
            <strong>✅ Buenas prácticas:</strong><br>
            • Siempre usa {{ }} para mostrar datos de usuario<br>
            • Solo usa {!! !!} con contenido confiable<br>
            • Valida y sanitiza toda entrada de usuario<br>
            • Usa Content Security Policy (CSP) headers<br>
            • Nunca confíes en datos del cliente
        </div>
    </div>
</body>
</html>
