<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance y Escalabilidad</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        header { text-align: center; margin-bottom: 40px; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; }
        .alert { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin-bottom: 32px; border-radius: 4px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .icon { font-size: 32px; margin-bottom: 12px; }
        h2 { font-size: 20px; font-weight: 600; margin-bottom: 12px; }
        p { color: #6b7280; margin-bottom: 16px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        .badge { display: inline-block; background: #f59e0b; color: #fff; padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-bottom: 8px; }
        .back { display: inline-block; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back">← Volver al inicio</a>
        
        <header>
            <h1>⚡ Performance y Escalabilidad</h1>
            <p class="subtitle">Detecta cuellos de botella y optimiza tu aplicación</p>
        </header>

        <div class="alert">
            <strong>💡 Importante:</strong> La optimización prematura es la raíz de todos los males. Mide primero, optimiza después.
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">💾</div>
                <span class="badge">ESENCIAL</span>
                <h2>1. Cache</h2>
                <p>Redis, Memcached y estrategias de caché.</p>
                <a href="/ejemplos/performance/cache">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🔍</div>
                <span class="badge">ESENCIAL</span>
                <h2>2. Query Optimization</h2>
                <p>Optimiza queries y elimina N+1.</p>
                <a href="/ejemplos/performance/query-optimization">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">📊</div>
                <h2>3. Horizon</h2>
                <p>Dashboard para monitorear queues.</p>
                <a href="/ejemplos/performance/horizon">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🔄</div>
                <h2>4. Lazy Collections</h2>
                <p>Procesa grandes datasets eficientemente.</p>
                <a href="/ejemplos/performance/lazy-collections">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🚀</div>
                <h2>5. Laravel Octane</h2>
                <p>Servidor de alto rendimiento.</p>
                <a href="/ejemplos/performance/octane">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">⚙️</div>
                <h2>6. Config & Route Cache</h2>
                <p>Cachea configuración y rutas.</p>
                <a href="/ejemplos/performance/config-cache">→ Ver ejemplos</a>
            </div>

            <div class="card">
                <div class="icon">🐳</div>
                <h2>7. Docker para Producción</h2>
                <p>Contenedores optimizados.</p>
                <a href="/ejemplos/performance/docker">→ Ver ejemplos</a>
            </div>
        </div>
    </div>
</body>
</html>
