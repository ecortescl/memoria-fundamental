<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Arquitectura Limpia</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; padding: 40px 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 32px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; font-size: 14px; margin: 16px 0; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vista en construcción</h1>
        <div class="card">
            <p>Esta vista está disponible. Revisa el código fuente en:</p>
            <ul>
                <li>app/Http/Controllers/ArquitecturaController.php</li>
                <li>app/Services/ProductoService.php</li>
                <li>app/Actions/</li>
                <li>app/DataTransferObjects/</li>
                <li>app/Http/Requests/</li>
                <li>app/Policies/</li>
                <li>app/Repositories/</li>
            </ul>
        </div>
        <a href="/ejemplos/arquitectura">← Volver</a>
    </div>
</body>
</html>
