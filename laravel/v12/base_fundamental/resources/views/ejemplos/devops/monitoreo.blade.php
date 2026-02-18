<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Monitoreo</title>
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
        <a href="/ejemplos/devops" class="back">← Volver</a>
        
        <h1>📊 Monitoreo</h1>

        <div class="card">
            <h2>🔍 Laravel Telescope</h2>
            <pre><code># Instalación
composer require laravel/telescope --dev

php artisan telescope:install
php artisan migrate

# Acceder
http://tu-app.test/telescope

# Monitorea:
# - Requests
# - Commands
# - Jobs
# - Exceptions
# - Logs
# - Queries
# - Cache
# - Redis</code></pre>
        </div>

        <div class="card">
            <h2>🐛 Sentry (Error Tracking)</h2>
            <pre><code># Instalación
composer require sentry/sentry-laravel

php artisan sentry:publish --dsn=tu-dsn

# .env
SENTRY_LARAVEL_DSN=https://...@sentry.io/...

# Captura automática de errores
# Dashboard en sentry.io muestra:
# - Stack traces
# - Contexto del usuario
# - Breadcrumbs
# - Release tracking

# Manual
try {
    // código
} catch (\Exception $e) {
    app('sentry')->captureException($e);
}</code></pre>
        </div>

        <div class="card">
            <h2>📈 New Relic (APM)</h2>
            <pre><code># Application Performance Monitoring
# - Tiempo de respuesta
# - Throughput
# - Error rate
# - Database queries
# - External services
# - Memory usage

# Instalación
# 1. Instalar agente New Relic
# 2. Configurar en php.ini
# 3. Dashboard automático en newrelic.com</code></pre>
        </div>

        <div class="card">
            <h2>📊 Laravel Pulse</h2>
            <pre><code># Monitoreo en tiempo real (Laravel 11+)
composer require laravel/pulse

php artisan pulse:install

# Dashboard
http://tu-app.test/pulse

# Métricas:
# - Requests más lentos
# - Uso de CPU/Memoria
# - Jobs fallidos
# - Excepciones
# - Cache hits/misses</code></pre>
        </div>

        <div class="card">
            <h2>🔔 Alertas</h2>
            <pre><code>// Notificar en Slack cuando hay error crítico
Log::channel('slack')->critical('Base de datos caída');

// Email cuando job falla
class ProcessPayment implements ShouldQueue
{
    public function failed(Throwable $exception)
    {
        Mail::to('admin@app.com')->send(
            new JobFailedNotification($this, $exception)
        );
    }
}</code></pre>
        </div>
    </div>
</body>
</html>
