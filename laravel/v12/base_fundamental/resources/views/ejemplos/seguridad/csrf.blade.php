<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Protection</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; color: #1f2937; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 24px; border-radius: 4px; }
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        code { font-family: 'Courier New', monospace; font-size: 14px; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
        .back:hover { color: #e02615; }
        ul { margin-left: 24px; margin-bottom: 16px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>🛡️ CSRF Protection</h1>

        <div class="alert">
            <strong>⚠️ ¿Qué es CSRF?</strong><br>
            Cross-Site Request Forgery: un atacante engaña al usuario para que ejecute acciones no deseadas en una aplicación donde está autenticado.
        </div>

        <div class="card">
            <h2>❌ Vulnerable (Sin protección)</h2>
            <pre><code>&lt;!-- Formulario SIN token CSRF --&gt;
&lt;form action="/productos" method="POST"&gt;
    &lt;input type="text" name="nombre"&gt;
    &lt;button type="submit"&gt;Crear&lt;/button&gt;
&lt;/form&gt;

&lt;!-- Un atacante puede crear un formulario malicioso --&gt;
&lt;form action="https://tu-app.com/productos" method="POST"&gt;
    &lt;input type="hidden" name="nombre" value="Producto Malicioso"&gt;
&lt;/form&gt;
&lt;script&gt;document.forms[0].submit();&lt;/script&gt;</code></pre>
        </div>

        <div class="card">
            <h2>✅ Protegido (Con Laravel)</h2>
            <pre><code>&lt;!-- Laravel genera automáticamente el token --&gt;
&lt;form action="/productos" method="POST"&gt;
    @@csrf
    &lt;input type="text" name="nombre"&gt;
    &lt;button type="submit"&gt;Crear&lt;/button&gt;
&lt;/form&gt;

&lt;!-- Genera esto: --&gt;
&lt;input type="hidden" name="_token" value="token-aleatorio-único"&gt;</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Configuración</h2>
            <pre><code>// app/Http/Middleware/VerifyCsrfToken.php

protected $except = [
    'api/*',  // Excluir rutas API
    'webhook/*'  // Excluir webhooks externos
];</code></pre>
        </div>

        <div class="card">
            <h2>📡 AJAX con CSRF</h2>
            <pre><code>// En tu layout principal
&lt;meta name="csrf-token" content="{{ csrf_token() }}"&gt;

// JavaScript
fetch('/api/productos', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ nombre: 'Producto' })
});</code></pre>
        </div>

        <div class="success alert">
            <strong>✅ Buenas prácticas:</strong>
            <ul>
                <li>Laravel protege automáticamente todas las rutas POST, PUT, PATCH, DELETE</li>
                <li>Siempre usa @@csrf en formularios</li>
                <li>Para APIs usa tokens de autenticación (Sanctum, Passport)</li>
                <li>No desactives CSRF sin una razón válida</li>
            </ul>
        </div>
    </div>
</body>
</html>
