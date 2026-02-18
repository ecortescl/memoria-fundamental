<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Docker</title>
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
        
        <h1>🐳 Docker</h1>

        <div class="card">
            <h2>🔧 Laravel Sail (desarrollo)</h2>
            <pre><code># Instalar Sail
composer require laravel/sail --dev

php artisan sail:install

# Iniciar
./vendor/bin/sail up -d

# Comandos
sail artisan migrate
sail composer install
sail npm run dev
sail test</code></pre>
        </div>

        <div class="card">
            <h2>📄 Dockerfile básico</h2>
            <pre><code>FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Comandos útiles</h2>
            <pre><code># Build imagen
docker build -t mi-app .

# Ejecutar contenedor
docker run -d -p 8000:8000 mi-app

# Ver contenedores
docker ps

# Logs
docker logs -f container_id

# Entrar al contenedor
docker exec -it container_id bash

# Limpiar
docker system prune -a</code></pre>
        </div>
    </div>
</body>
</html>
