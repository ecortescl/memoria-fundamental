<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones - Laravel</title>
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
        .result { background: #f9fafb; padding: 16px; margin: 12px 0; border-left: 4px solid #FF2D20; border-radius: 4px; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; color: #FF2D20; font-size: 14px; }
        pre { background: #1f2937; color: #10b981; padding: 16px; border-radius: 4px; overflow-x: auto; font-size: 14px; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { color: #e02615; }
        ul { margin-left: 20px; }
        li { margin: 8px 0; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚙️ Funciones en Controladores</h1>
        
        <div class="card">
            <h2>Función 1: Saludo Simple</h2>
            <pre>private function saludar($nombre)
{
    return "Hola, {$nombre}!";
}</pre>
            <div class="result">
                <strong>Resultado:</strong> {{ $saludo }}
            </div>
        </div>
        
        <div class="card">
            <h2>Función 2: Cálculo con Parámetros</h2>
            <pre>private function calcularTotal($precio, $cantidad, $descuento = 0)
{
    $subtotal = $precio * $cantidad;
    $total = $subtotal - ($subtotal * $descuento / 100);
    return $total;
}</pre>
            <div class="result">
                <strong>Llamada:</strong> <code>calcularTotal(100, 3, 10)</code><br>
                <strong>Resultado:</strong> ${{ number_format($total, 2) }}
                <p>
                    <small>
                        Precio: $100 × Cantidad: 3 = $300<br>
                        Descuento 10%: -$30<br>
                        Total: $270
                    </small>
                </p>
            </div>
        </div>
        
        <div class="card">
            <h2>Función 3: Retorna Array</h2>
            <pre>private function obtenerEstadisticas()
{
    return [
        'usuarios' => 150,
        'productos' => 45,
        'ventas' => 1200
    ];
}</pre>
            <div class="result">
                <strong>Resultado:</strong>
                <ul>
                    <li>👥 Usuarios: {{ $estadisticas['usuarios'] }}</li>
                    <li>📦 Productos: {{ $estadisticas['productos'] }}</li>
                    <li>💰 Ventas: {{ $estadisticas['ventas'] }}</li>
                </ul>
            </div>
        </div>
        
        <div class="card">
            <h3>💡 Conceptos Aprendidos:</h3>
            <ul>
                <li><code>private function</code> solo se usa dentro del controlador</li>
                <li><code>public function</code> puede ser llamada desde rutas</li>
                <li>Parámetros con valor por defecto: <code>$descuento = 0</code></li>
                <li>Llamar función privada: <code>$this->nombreFuncion()</code></li>
                <li>Funciones pueden retornar cualquier tipo de dato</li>
                <li>Interpolación de strings: <code>"Hola, {$nombre}!"</code></li>
            </ul>
        </div>
        
        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
