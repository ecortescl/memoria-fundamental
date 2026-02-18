<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad en Laravel</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        header { text-align: center; margin-bottom: 40px; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 32px; border-radius: 4px; }
        .alert strong { color: #dc2626; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .icon { font-size: 32px; margin-bottom: 12px; }
        h2 { font-size: 20px; font-weight: 600; margin-bottom: 12px; }
        p { color: #6b7280; margin-bottom: 16px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        .badge { display: inline-block; background: #ef4444; color: #fff; padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-bottom: 8px; }
        .back { display: inline-block; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back">← Volver al inicio</a>
        
        <header>
            <h1>🔒 Seguridad en Laravel</h1>
            <p class="subtitle">Un senior piensa primero en seguridad</p>
        </header>

        <div class="alert">
            <strong>⚠️ Crítico:</strong> La seguridad no es opcional. Cada vulnerabilidad puede comprometer toda tu aplicación y los datos de tus usuarios.
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">🛡️</div>
                <span class="badge">CRÍTICO</span>
                <h2>1. CSRF Protection</h2>
                <p>Protección contra Cross-Site Request Forgery.</p>
                <a href="/ejemplos/seguridad/csrf">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🚫</div>
                <span class="badge">CRÍTICO</span>
                <h2>2. XSS Prevention</h2>
                <p>Prevención de Cross-Site Scripting.</p>
                <a href="/ejemplos/seguridad/xss">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">💉</div>
                <span class="badge">CRÍTICO</span>
                <h2>3. SQL Injection</h2>
                <p>Protección contra inyección SQL.</p>
                <a href="/ejemplos/seguridad/sql-injection">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">📝</div>
                <span class="badge">CRÍTICO</span>
                <h2>4. Mass Assignment</h2>
                <p>Protección contra asignación masiva.</p>
                <a href="/ejemplos/seguridad/mass-assignment">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🔐</div>
                <h2>5. Hashing</h2>
                <p>Hash seguro de contraseñas con Bcrypt.</p>
                <a href="/ejemplos/seguridad/hashing">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🔑</div>
                <h2>6. Encriptación</h2>
                <p>Encriptar y desencriptar datos sensibles.</p>
                <a href="/ejemplos/seguridad/encriptacion">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">⏱️</div>
                <h2>7. Rate Limiting</h2>
                <p>Limitar intentos para prevenir ataques.</p>
                <a href="/ejemplos/seguridad/rate-limiting">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">✅</div>
                <h2>8. Validaciones Robustas</h2>
                <p>Validar y sanitizar toda entrada de usuario.</p>
                <a href="/ejemplos/seguridad/validaciones">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">💾</div>
                <h2>9. Storage Seguro</h2>
                <p>Almacenamiento seguro de archivos.</p>
                <a href="/ejemplos/seguridad/storage">→ Ver ejemplos</a>
            </div>
        </div>
    </div>
</body>
</html>
