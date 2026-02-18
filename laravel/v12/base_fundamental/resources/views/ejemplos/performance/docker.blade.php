<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Docker para Producción</title>
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
        <a href="/ejemplos/performance" class="back">← Volver</a>
        
        <h1>🐳 Docker para Producción</h1>

        <div class="card">
            <h2>📄 Dockerfile optimizado</h2>
            <pre><code>FROM php:8.3-fpm-alpine

# Instalar extensiones
RUN apk add --no-cache \
    postgresql-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo pdo_pgsql opcache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio
WORKDIR /var/www

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Optimizaciones Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permisos
RUN chown -R www-data:www-data /var/www

USER www-data

EXPOSE 9000

CMD ["php-fpm"]</code></pre>
        </div>

        <div class="card">
            <h2>📄 docker-compose.yml</h2>
            <pre><code>version: '3.8'

services:
  app:
    build: .
    container_name: laravel-app
    restart: unless-stopped
    volumes:
      - ./storage:/var/www/storage
    networks:
      - laravel

  nginx:
    image: nginx:alpine
    container_name: laravel-nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - laravel

  db:
    image: postgres:15-alpine
    container_name: laravel-db
    restart: unless-stopped
    environment:
      POSTGRES_DB: laravel
      POSTGRES_USER: laravel
      POSTGRES_PASSWORD: secret
    volumes:
      - dbdata:/var/lib/postgresql/data
    networks:
      - laravel

  redis:
    image: redis:alpine
    container_name: laravel-redis
    restart: unless-stopped
    networks:
      - laravel

networks:
  laravel:
    driver: bridge

volumes:
  dbdata:</code></pre>
        </div>

        <div class="card">
            <h2>⚙️ Nginx config</h2>
            <pre><code>server {
    listen 80;
    index index.php;
    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Comandos</h2>
            <pre><code># Build y ejecutar
docker-compose up -d --build

# Ver logs
docker-compose logs -f app

# Ejecutar comandos
docker-compose exec app php artisan migrate

# Detener
docker-compose down</code></pre>
        </div>
    </div>
</body>
</html>
