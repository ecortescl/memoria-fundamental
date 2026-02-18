<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Config & Route Cache</title>
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
        .success { background: #f0fdf4; border-left: 4px solid #22c55e; padding: 16px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>⚙️ Config & Route Cache</h1>

        <div class="card">
            <h2>🔧 Config Cache</h2>
            <pre><code># Cachear configuración (producción)
php artisan config:cache

# Limpiar cache de configuración
php artisan config:clear

# ⚠️ Después de cachear, env() solo funciona en archivos config/</code></pre>
            <div class="success">
                <strong>✅ Mejora:</strong> ~50ms más rápido por request
            </div>
        </div>

        <div class="card">
            <h2>🔧 Route Cache</h2>
            <pre><code># Cachear rutas (producción)
php artisan route:cache

# Limpiar cache de rutas
php artisan route:clear

# ⚠️ No funciona con closures en rutas</code></pre>
            <div class="success">
                <strong>✅ Mejora:</strong> ~30ms más rápido por request
            </div>
        </div>

        <div class="card">
            <h2>🔧 View Cache</h2>
            <pre><code># Precompilar vistas Blade
php artisan view:cache

# Limpiar cache de vistas
php artisan view:clear</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Event Cache</h2>
            <pre><code># Cachear eventos y listeners
php artisan event:cache

# Limpiar
php artisan event:clear</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Script de deploy</h2>
            <pre><code>#!/bin/bash

# Actualizar código
git pull origin main

# Instalar dependencias
composer install --no-dev --optimize-autoloader

# Optimizaciones
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Migraciones
php artisan migrate --force

# Reiniciar servicios
php artisan queue:restart
php artisan octane:reload  # Si usas Octane</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Optimize command</h2>
            <pre><code># Ejecuta múltiples optimizaciones
php artisan optimize

# Equivale a:
# - config:cache
# - route:cache
# - view:cache

# Limpiar todas las optimizaciones
php artisan optimize:clear</code></pre>
        </div>
    </div>
</body>
</html>
