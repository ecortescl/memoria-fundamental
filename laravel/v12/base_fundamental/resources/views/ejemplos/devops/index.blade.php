<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevOps y Entorno Real</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        header { text-align: center; margin-bottom: 40px; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; }
        .alert { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 16px; margin-bottom: 32px; border-radius: 4px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .icon { font-size: 32px; margin-bottom: 12px; }
        h2 { font-size: 20px; font-weight: 600; margin-bottom: 12px; }
        p { color: #6b7280; margin-bottom: 16px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        .badge { display: inline-block; background: #3b82f6; color: #fff; padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-bottom: 8px; }
        .back { display: inline-block; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back">← Volver al inicio</a>
        
        <header>
            <h1>🚀 DevOps y Entorno Real</h1>
            <p class="subtitle">Un senior no solo programa, también despliega y monitorea</p>
        </header>

        <div class="alert">
            <strong>💡 Importante:</strong> Conocer DevOps te diferencia. Puedes llevar tu código desde desarrollo hasta producción de forma profesional.
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">🐳</div>
                <span class="badge">ESENCIAL</span>
                <h2>1. Docker</h2>
                <p>Contenedores para desarrollo y producción.</p>
                <a href="/ejemplos/devops/docker">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🔄</div>
                <span class="badge">ESENCIAL</span>
                <h2>2. CI/CD</h2>
                <p>Integración y despliegue continuo.</p>
                <a href="/ejemplos/devops/cicd">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🌿</div>
                <h2>3. Git Avanzado</h2>
                <p>Workflows, rebase, cherry-pick, hooks.</p>
                <a href="/ejemplos/devops/git">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">☁️</div>
                <h2>4. Deploy</h2>
                <p>Forge, Vapor, VPS, AWS, DigitalOcean.</p>
                <a href="/ejemplos/devops/deploy">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">📝</div>
                <h2>5. Logs</h2>
                <p>Monolog, canales, stack traces.</p>
                <a href="/ejemplos/devops/logs">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">📊</div>
                <h2>6. Monitoreo</h2>
                <p>Sentry, New Relic, Telescope.</p>
                <a href="/ejemplos/devops/monitoreo">→ Ver ejemplos</a>
            </div>
        </div>
    </div>
</body>
</html>
