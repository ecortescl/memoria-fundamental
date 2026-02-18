<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deploy</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; font-size: 13px; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/devops" class="back">← Volver</a>
        
        <h1>☁️ Deploy</h1>

        <div class="card">
            <h2>🚀 Laravel Forge</h2>
            <pre><code># Plataforma oficial de Laravel
# - Gestión de servidores
# - Deploy automático desde Git
# - SSL gratis (Let's Encrypt)
# - Scheduled jobs
# - Queue workers

# Precio: $12/mes + servidor
# Servidores: DigitalOcean, AWS, Linode, Vultr

# Deploy script automático:
cd /home/forge/app.com
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan queue:restart</code></pre>
        </div>

        <div class="card">
            <h2>⚡ Laravel Vapor</h2>
            <pre><code># Serverless en AWS Lambda
# - Auto-scaling
# - Pay per use
# - Zero downtime
# - Assets en CloudFront CDN

# vapor.yml
id: 12345
name: mi-app
environments:
    production:
        memory: 1024
        cli-memory: 512
        runtime: 'php-8.3:al2'
        build:
            - 'composer install --no-dev'
        deploy:
            - 'php artisan migrate --force'

# Deploy
vapor deploy production</code></pre>
        </div>

        <div class="card">
            <h2>🖥️ VPS Manual (Ubuntu)</h2>
            <pre><code># 1. Instalar dependencias
sudo apt update
sudo apt install nginx php8.3-fpm php8.3-mysql composer

# 2. Configurar Nginx
server {
    listen 80;
    server_name app.com;
    root /var/www/app/public;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        include fastcgi_params;
    }
}

# 3. Permisos
sudo chown -R www-data:www-data /var/www/app
sudo chmod -R 755 /var/www/app/storage

# 4. Deploy script
#!/bin/bash
cd /var/www/app
git pull
composer install --no-dev
php artisan migrate --force
php artisan optimize</code></pre>
        </div>

        <div class="card">
            <h2>☁️ Plataformas alternativas</h2>
            <pre><code># Heroku
# - Fácil de usar
# - Dyno gratis (limitado)
# - Addons para DB, Redis, etc

# DigitalOcean App Platform
# - $5/mes
# - Deploy desde Git
# - Managed databases

# AWS Elastic Beanstalk
# - Auto-scaling
# - Load balancing
# - Más complejo

# Vercel / Netlify
# - Solo para frontend
# - No soportan PHP backend</code></pre>
        </div>
    </div>
</body>
</html>
