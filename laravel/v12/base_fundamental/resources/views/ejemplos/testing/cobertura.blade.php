<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cobertura de Código</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 28px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin-bottom: 16px; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; font-size: 13px; margin: 16px 0; line-height: 1.5; }
        ul { margin: 12px 0 12px 24px; }
        li { margin: 8px 0; color: #4b5563; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Cobertura de Código</h1>
        <p class="subtitle">Mide qué porcentaje está testeado</p>

        <div class="card">
            <h2>Generar Reporte</h2>
            <pre><code># Con PHPUnit
php artisan test --coverage

# Con mínimo de cobertura
php artisan test --coverage --min=80

# Reporte HTML
php artisan test --coverage-html coverage</code></pre>
        </div>

        <div class="card">
            <h2>¿Qué Porcentaje Buscar?</h2>
            <ul>
                <li><strong>80%+:</strong> Excelente para la mayoría de proyectos</li>
                <li><strong>60-80%:</strong> Aceptable</li>
                <li><strong><60%:</strong> Necesitas más tests</li>
                <li><strong>100%:</strong> No siempre necesario ni práctico</li>
            </ul>
        </div>

        <div class="card">
            <h2>Cobertura ≠ Calidad</h2>
            <p>100% de cobertura no garantiza código sin bugs. Lo importante es la calidad de los tests, no solo la cantidad.</p>
        </div>

        <a href="/ejemplos/testing">← Volver</a>
    </div>
</body>
</html>
