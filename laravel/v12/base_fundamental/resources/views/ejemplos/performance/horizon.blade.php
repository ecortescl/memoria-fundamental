<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Laravel Horizon</title>
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
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>📊 Laravel Horizon</h1>

        <div class="card">
            <h2>📦 Instalación</h2>
            <pre><code>composer require laravel/horizon

php artisan horizon:install

php artisan migrate</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Configuración</h2>
            <pre><code>// config/horizon.php
'environments' => [
    'production' => [
        'supervisor-1' => [
            'connection' => 'redis',
            'queue' => ['default', 'emails', 'reports'],
            'balance' => 'auto',
            'processes' => 10,
            'tries' => 3,
            'timeout' => 60,
        ],
    ],
    
    'local' => [
        'supervisor-1' => [
            'connection' => 'redis',
            'queue' => ['default'],
            'balance' => 'auto',
            'processes' => 3,
            'tries' => 3,
        ],
    ],
],</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Ejecutar</h2>
            <pre><code># Desarrollo
php artisan horizon

# Producción (con Supervisor)
[program:horizon]
command=php /path/to/artisan horizon
directory=/path/to/project
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/path/to/horizon.log</code></pre>
        </div>

        <div class="card">
            <h2>📊 Dashboard</h2>
            <pre><code>// Acceder al dashboard
http://tu-app.test/horizon

// Proteger en producción (app/Providers/HorizonServiceProvider.php)
protected function gate()
{
    Gate::define('viewHorizon', function ($user) {
        return in_array($user->email, [
            'admin@example.com',
        ]);
    });
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Comandos útiles</h2>
            <pre><code># Pausar procesamiento
php artisan horizon:pause

# Continuar
php artisan horizon:continue

# Terminar gracefully
php artisan horizon:terminate

# Limpiar jobs fallidos
php artisan horizon:clear

# Ver métricas
php artisan horizon:snapshot</code></pre>
        </div>
    </div>
</body>
</html>
