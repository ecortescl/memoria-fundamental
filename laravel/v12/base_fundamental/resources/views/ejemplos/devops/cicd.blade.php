<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CI/CD</title>
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
        
        <h1>🔄 CI/CD</h1>

        <div class="card">
            <h2>📄 GitHub Actions</h2>
            <pre><code># .github/workflows/laravel.yml
name: Laravel CI

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_DATABASE: testing
          MYSQL_ROOT_PASSWORD: password
        ports:
          - 3306:3306
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.3'
        extensions: mbstring, pdo_mysql
    
    - name: Install Dependencies
      run: composer install
    
    - name: Copy .env
      run: cp .env.example .env
    
    - name: Generate key
      run: php artisan key:generate
    
    - name: Run tests
      run: php artisan test
      env:
        DB_CONNECTION: mysql
        DB_HOST: 127.0.0.1
        DB_PORT: 3306
        DB_DATABASE: testing
        DB_USERNAME: root
        DB_PASSWORD: password</code></pre>
        </div>

        <div class="card">
            <h2>📄 GitLab CI</h2>
            <pre><code># .gitlab-ci.yml
image: php:8.3

stages:
  - test
  - deploy

test:
  stage: test
  services:
    - mysql:8.0
  variables:
    MYSQL_DATABASE: testing
    MYSQL_ROOT_PASSWORD: password
  script:
    - apt-get update && apt-get install -y git unzip
    - curl -sS https://getcomposer.org/installer | php
    - php composer.phar install
    - cp .env.example .env
    - php artisan key:generate
    - php artisan test

deploy:
  stage: deploy
  only:
    - main
  script:
    - ssh user@server "cd /var/www && git pull && php artisan migrate --force"</code></pre>
        </div>

        <div class="card">
            <h2>🚀 Deploy automático</h2>
            <pre><code># .github/workflows/deploy.yml
name: Deploy

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
    - name: Deploy to production
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/app
          git pull origin main
          composer install --no-dev
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan queue:restart</code></pre>
        </div>
    </div>
</body>
</html>
