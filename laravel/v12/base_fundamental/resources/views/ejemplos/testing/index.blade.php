<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing en Laravel</title>
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
        <h1>🧪 Testing en Laravel</h1>
        <p class="subtitle">Lo que diferencia a un Junior de un Senior</p>

        <div class="info-box">
            <strong>📚 Sobre esta sección:</strong> Un senior escribe tests primero o al menos consistentemente. 
            Aprende PHPUnit, Pest, Feature Tests, Unit Tests, Mocking y más. Los tests son tu red de seguridad.
        </div>

        <div class="principle-box">
            <h3>🎯 Por Qué Testing es Crucial</h3>
            <ul>
                <li><strong>Confianza:</strong> Refactoriza sin miedo a romper cosas</li>
                <li><strong>Documentación:</strong> Los tests documentan cómo usar tu código</li>
                <li><strong>Diseño:</strong> Código testeable es código bien diseñado</li>
                <li><strong>Debugging:</strong> Encuentra bugs antes que tus usuarios</li>
                <li><strong>Profesionalismo:</strong> Es lo que hacen los seniors</li>
            </ul>
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">📖</div>
                <span class="badge">EMPEZAR AQUÍ</span>
                <h2>1. Introducción</h2>
                <p>Conceptos básicos de testing en Laravel.</p>
                <ul>
                    <li>¿Por qué testear?</li>
                    <li>Tipos de tests</li>
                    <li>Configuración inicial</li>
                    <li>Estructura de tests</li>
                </ul>
                <a href="/ejemplos/testing/introduccion">Ver Introducción →</a>
            </div>

            <div class="card">
                <div class="icon">⚔️</div>
                <span class="badge">COMPARACIÓN</span>
                <h2>2. PHPUnit vs Pest</h2>
                <p>Compara las dos herramientas de testing más usadas.</p>
                <ul>
                    <li>Sintaxis PHPUnit</li>
                    <li>Sintaxis Pest (moderna)</li>
                    <li>Ventajas de cada una</li>
                    <li>Cuál elegir</li>
                </ul>
                <a href="/ejemplos/testing/phpunit-vs-pest">Ver Comparación →</a>
            </div>

            <div class="card">
                <div class="icon">🌐</div>
                <span class="badge">ESENCIAL</span>
                <h2>3. Feature Tests</h2>
                <p>Tests de integración que prueban flujos completos.</p>
                <ul>
                    <li>HTTP requests</li>
                    <li>Autenticación</li>
                    <li>Base de datos</li>
                    <li>Assertions</li>
                </ul>
                <a href="/ejemplos/testing/feature-tests">Ver Feature Tests →</a>
            </div>

            <div class="card">
                <div class="icon">🔬</div>
                <h2>4. Unit Tests</h2>
                <p>Tests aislados de clases y métodos individuales.</p>
                <ul>
                    <li>Testing de Actions</li>
                    <li>Testing de Services</li>
                    <li>Testing de DTOs</li>
                    <li>Testing de Helpers</li>
                </ul>
                <a href="/ejemplos/testing/unit-tests">Ver Unit Tests →</a>
            </div>

            <div class="card">
                <div class="icon">🎭</div>
                <span class="badge">AVANZADO</span>
                <h2>5. Mocking</h2>
                <p>Simula dependencias para tests aislados.</p>
                <ul>
                    <li>Mocks vs Fakes</li>
                    <li>Mockery</li>
                    <li>Laravel Fakes</li>
                    <li>Cuándo usar cada uno</li>
                </ul>
                <a href="/ejemplos/testing/mocking">Ver Mocking →</a>
            </div>

            <div class="card">
                <div class="icon">⚙️</div>
                <h2>6. Testing de Jobs</h2>
                <p>Prueba trabajos en cola y procesos asíncronos.</p>
                <ul>
                    <li>Queue::fake()</li>
                    <li>Assertions de Jobs</li>
                    <li>Testing de chains</li>
                    <li>Testing de batches</li>
                </ul>
                <a href="/ejemplos/testing/jobs">Ver Jobs →</a>
            </div>

            <div class="card">
                <div class="icon">📡</div>
                <h2>7. Testing de Events</h2>
                <p>Verifica que eventos se disparan correctamente.</p>
                <ul>
                    <li>Event::fake()</li>
                    <li>Listeners</li>
                    <li>Event assertions</li>
                    <li>Testing de observers</li>
                </ul>
                <a href="/ejemplos/testing/events">Ver Events →</a>
            </div>

            <div class="card">
                <div class="icon">🔌</div>
                <span class="badge">IMPORTANTE</span>
                <h2>8. Testing de APIs</h2>
                <p>Prueba endpoints REST y respuestas JSON.</p>
                <ul>
                    <li>JSON assertions</li>
                    <li>Status codes</li>
                    <li>Headers</li>
                    <li>Autenticación API</li>
                </ul>
                <a href="/ejemplos/testing/apis">Ver APIs →</a>
            </div>

            <div class="card">
                <div class="icon">🔄</div>
                <span class="badge">METODOLOGÍA</span>
                <h2>9. TDD</h2>
                <p>Test-Driven Development: escribe tests primero.</p>
                <ul>
                    <li>Red-Green-Refactor</li>
                    <li>Ventajas de TDD</li>
                    <li>Ejemplo práctico</li>
                    <li>Cuándo usar TDD</li>
                </ul>
                <a href="/ejemplos/testing/tdd">Ver TDD →</a>
            </div>

            <div class="card">
                <div class="icon">📊</div>
                <h2>10. Cobertura</h2>
                <p>Mide qué porcentaje de tu código está testeado.</p>
                <ul>
                    <li>Xdebug + PHPUnit</li>
                    <li>Interpretar reportes</li>
                    <li>Qué porcentaje buscar</li>
                    <li>Coverage vs calidad</li>
                </ul>
                <a href="/ejemplos/testing/cobertura">Ver Cobertura →</a>
            </div>
        </div>

        <div class="principle-box">
            <h3>💡 Comandos Útiles</h3>
            <ul>
                <li><strong>php artisan test:</strong> Ejecutar todos los tests</li>
                <li><strong>php artisan test --filter NombreTest:</strong> Ejecutar test específico</li>
                <li><strong>php artisan test --parallel:</strong> Tests en paralelo (más rápido)</li>
                <li><strong>php artisan test --coverage:</strong> Ver cobertura de código</li>
                <li><strong>php artisan make:test NombreTest:</strong> Crear Feature Test</li>
                <li><strong>php artisan make:test NombreTest --unit:</strong> Crear Unit Test</li>
            </ul>
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
