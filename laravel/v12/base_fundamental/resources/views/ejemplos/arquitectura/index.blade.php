<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquitectura Limpia - Laravel</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 42px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 40px; }
        .info-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 20px; margin-bottom: 40px; border-radius: 4px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .card { background: #fff; padding: 28px; border-radius: 4px; border: 1px solid #e5e7eb; transition: all 0.2s; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-color: #FF2D20; }
        .icon { font-size: 36px; margin-bottom: 16px; }
        .card h2 { font-size: 22px; font-weight: 600; color: #1f2937; margin-bottom: 12px; }
        .card p { color: #6b7280; margin-bottom: 16px; font-size: 15px; }
        .card ul { list-style: none; margin: 16px 0; }
        .card li { margin: 8px 0; color: #4b5563; }
        .card li:before { content: "→ "; color: #FF2D20; font-weight: 600; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { text-decoration: underline; }
        .badge { display: inline-block; background: #FF2D20; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; margin-bottom: 12px; }
        .principle-box { background: #fff; border: 2px solid #FF2D20; padding: 24px; border-radius: 4px; margin-bottom: 40px; }
        .principle-box h3 { color: #FF2D20; margin-bottom: 16px; }
        .principle-box ul { list-style: none; padding: 0; }
        .principle-box li { padding: 8px 0; border-bottom: 1px solid #e5e7eb; }
        .principle-box li:last-child { border-bottom: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏗️ Arquitectura Limpia en Laravel</h1>
        <p class="subtitle">Organiza tu código de forma profesional y mantenible</p>

        <div class="info-box">
            <strong>📚 Sobre esta sección:</strong> Aprende a estructurar aplicaciones Laravel siguiendo principios SOLID y arquitectura limpia. 
            No todo debe ir en el Controller. Verás ejemplos reales de código bien organizado vs código problemático.
        </div>

        <div class="principle-box">
            <h3>🎯 Principios Fundamentales</h3>
            <ul>
                <li><strong>Single Responsibility:</strong> Cada clase tiene una sola razón para cambiar</li>
                <li><strong>Separation of Concerns:</strong> Separa validación, lógica de negocio y presentación</li>
                <li><strong>Dependency Injection:</strong> Inyecta dependencias en lugar de crearlas</li>
                <li><strong>Testability:</strong> Código fácil de testear</li>
                <li><strong>Maintainability:</strong> Fácil de entender y modificar</li>
            </ul>
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">🎮</div>
                <span class="badge">ESENCIAL</span>
                <h2>1. Controllers Limpios</h2>
                <p>Los controllers deben ser delgados y solo coordinar.</p>
                <ul>
                    <li>Thin Controllers</li>
                    <li>Inyección de dependencias</li>
                    <li>Delegación a Services</li>
                    <li>Respuestas consistentes</li>
                </ul>
                <a href="/ejemplos/arquitectura/controller-limpio">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">✅</div>
                <h2>2. Form Requests</h2>
                <p>Encapsula validación y autorización fuera del controller.</p>
                <ul>
                    <li>Validación centralizada</li>
                    <li>Mensajes personalizados</li>
                    <li>Autorización integrada</li>
                    <li>Código reutilizable</li>
                </ul>
                <a href="/ejemplos/arquitectura/form-requests">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">📦</div>
                <h2>3. DTOs (Data Transfer Objects)</h2>
                <p>Objetos inmutables para transferir datos entre capas.</p>
                <ul>
                    <li>Type-safe data transfer</li>
                    <li>Inmutabilidad</li>
                    <li>Validación de datos</li>
                    <li>Conversión fácil</li>
                </ul>
                <a href="/ejemplos/arquitectura/dtos">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">⚡</div>
                <span class="badge">RECOMENDADO</span>
                <h2>4. Actions</h2>
                <p>Clases con una sola responsabilidad para operaciones específicas.</p>
                <ul>
                    <li>Single Responsibility</li>
                    <li>Reutilizables</li>
                    <li>Fáciles de testear</li>
                    <li>Lógica de negocio aislada</li>
                </ul>
                <a href="/ejemplos/arquitectura/actions">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🔧</div>
                <h2>5. Services</h2>
                <p>Coordinan múltiples operaciones y encapsulan lógica compleja.</p>
                <ul>
                    <li>Coordinación de Actions</li>
                    <li>Lógica de negocio compleja</li>
                    <li>Múltiples modelos</li>
                    <li>Transacciones</li>
                </ul>
                <a href="/ejemplos/arquitectura/services">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🗄️</div>
                <h2>6. Repositories</h2>
                <p>Abstrae el acceso a datos (úsalos solo cuando sea necesario).</p>
                <ul>
                    <li>Abstracción de datos</li>
                    <li>Queries reutilizables</li>
                    <li>Testing más fácil</li>
                    <li>Cuándo SÍ / cuándo NO</li>
                </ul>
                <a href="/ejemplos/arquitectura/repositories">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🔐</div>
                <span class="badge">SEGURIDAD</span>
                <h2>7. Policies & Gates</h2>
                <p>Centraliza la lógica de autorización.</p>
                <ul>
                    <li>Autorización centralizada</li>
                    <li>Reutilizable en Blade</li>
                    <li>Fácil de mantener</li>
                    <li>Permisos granulares</li>
                </ul>
                <a href="/ejemplos/arquitectura/policies">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">⚖️</div>
                <span class="badge">COMPARACIÓN</span>
                <h2>8. Malo vs Bueno</h2>
                <p>Compara código problemático con código limpio.</p>
                <ul>
                    <li>Antipatrones comunes</li>
                    <li>Refactoring paso a paso</li>
                    <li>Before & After</li>
                    <li>Best practices</li>
                </ul>
                <a href="/ejemplos/arquitectura/comparacion">Ver Ejemplo →</a>
            </div>
        </div>

        <div class="principle-box">
            <h3>💡 Cuándo Usar Cada Patrón</h3>
            <ul>
                <li><strong>Form Requests:</strong> Siempre para validación</li>
                <li><strong>DTOs:</strong> Cuando transfieres datos entre capas o APIs</li>
                <li><strong>Actions:</strong> Para operaciones específicas reutilizables</li>
                <li><strong>Services:</strong> Para lógica de negocio compleja que coordina múltiples operaciones</li>
                <li><strong>Repositories:</strong> Solo si necesitas abstraer el origen de datos o queries muy complejas</li>
                <li><strong>Policies:</strong> Siempre para autorización</li>
            </ul>
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
