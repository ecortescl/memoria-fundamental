<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables desde Request - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; padding: 24px; margin: 20px 0; border-radius: 4px; border: 1px solid #e5e7eb; }
        h1 { color: #FF2D20; font-size: 36px; font-weight: 600; margin-bottom: 32px; }
        h2 { color: #1f2937; font-size: 24px; font-weight: 600; margin-bottom: 16px; }
        h3 { color: #1f2937; font-size: 18px; font-weight: 600; margin: 20px 0 12px; }
        input, button { padding: 10px; margin: 5px; border-radius: 4px; border: 1px solid #e5e7eb; font-family: 'Figtree', sans-serif; }
        button { background: #FF2D20; color: white; cursor: pointer; border: none; font-weight: 500; }
        button:hover { background: #e02615; }
        .info { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; color: #FF2D20; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Variables desde Request</h1>
        
        <div class="card">
            <h2>Valores Recibidos:</h2>
            <div class="info">
                <strong>Nombre:</strong> {{ $nombre }}
            </div>
            <div class="info">
                <strong>Email:</strong> {{ $email }}
            </div>
        </div>
        
        <div class="card">
            <h2>Prueba con Formulario (POST):</h2>
            <form method="POST" action="/ejemplos/variables/request">
                @csrf
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" placeholder="Tu nombre" required>
                </div>
                <button type="submit">Enviar POST</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Prueba con Query String (GET):</h2>
            <p>Prueba estos enlaces:</p>
            <ul>
                <li><a href="/ejemplos/variables/request?email=juan@example.com">?email=juan@example.com</a></li>
                <li><a href="/ejemplos/variables/request?email=maria@example.com&nombre=María">?email=maria@example.com&nombre=María</a></li>
            </ul>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos Aprendidos:</h3>
            <ul>
                <li><code>$request->input('nombre')</code> obtiene datos POST/GET</li>
                <li><code>$request->query('email')</code> obtiene solo de query string</li>
                <li>Segundo parámetro es valor por defecto: <code>input('nombre', 'Invitado')</code></li>
                <li><code>@csrf</code> es obligatorio en formularios POST para seguridad</li>
                <li>Query string: <code>?clave=valor&otra=valor2</code></li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
