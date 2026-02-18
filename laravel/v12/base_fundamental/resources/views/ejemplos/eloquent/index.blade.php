<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eloquent Avanzado - Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
            padding: 40px 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { 
            font-size: 42px;
            font-weight: 600;
            color: #FF2D20;
            margin-bottom: 12px;
        }
        .subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 40px;
        }
        .info-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 4px;
        }
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); 
            gap: 24px;
            margin-bottom: 40px;
        }
        .card { 
            background: #fff;
            padding: 28px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-color: #FF2D20;
        }
        .icon {
            font-size: 36px;
            margin-bottom: 16px;
        }
        .card h2 { 
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
        }
        .card p {
            color: #6b7280;
            margin-bottom: 16px;
            font-size: 15px;
        }
        .card ul {
            list-style: none;
            margin: 16px 0;
        }
        .card li {
            margin: 8px 0;
            color: #4b5563;
        }
        .card li:before {
            content: "→ ";
            color: #FF2D20;
            font-weight: 600;
        }
        a { 
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 14px;
            color: #FF2D20;
            font-family: 'Courier New', monospace;
        }
        .badge {
            display: inline-block;
            background: #FF2D20;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .setup-box {
            background: #fff;
            border: 2px solid #FF2D20;
            padding: 24px;
            border-radius: 4px;
            margin-bottom: 40px;
        }
        .setup-box h3 {
            color: #FF2D20;
            margin-bottom: 16px;
        }
        .command {
            background: #1f2937;
            color: #10b981;
            padding: 12px 16px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Eloquent Avanzado</h1>
        <p class="subtitle">Domina las técnicas avanzadas de Eloquent ORM</p>

        <div class="setup-box">
            <h3>⚙️ Configuración Inicial</h3>
            <p>Antes de explorar los ejemplos, ejecuta estos comandos:</p>
            <div class="command">php artisan migrate</div>
            <div class="command">php artisan db:seed --class=EloquentAvanzadoSeeder</div>
            <p style="margin-top: 12px; color: #6b7280; font-size: 14px;">
                Esto creará las tablas necesarias y poblará la base de datos con datos de ejemplo.
            </p>
        </div>

        <div class="info-box">
            <strong>📚 Sobre estos ejemplos:</strong> Cada sección incluye código real ejecutándose con datos de la base de datos. 
            Podrás ver queries SQL, comparar performance y entender el problema N+1.
        </div>

        <div class="grid">
            <div class="card">
                <div class="icon">🔗</div>
                <span class="badge">ESENCIAL</span>
                <h2>1. Relaciones y Eager Loading</h2>
                <p>Aprende a cargar relaciones eficientemente y evitar el problema N+1.</p>
                <ul>
                    <li>Eager Loading básico</li>
                    <li>Eager Loading con condiciones</li>
                    <li>Problema N+1 demostrado</li>
                    <li>Comparación de queries</li>
                </ul>
                <a href="/ejemplos/eloquent/relaciones">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🔄</div>
                <span class="badge">AVANZADO</span>
                <h2>2. Relaciones Polimórficas</h2>
                <p>Una tabla que se relaciona con múltiples modelos.</p>
                <ul>
                    <li>morphMany / morphTo</li>
                    <li>Imágenes compartidas</li>
                    <li>Casos de uso reales</li>
                </ul>
                <a href="/ejemplos/eloquent/polimorficas">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">⚙️</div>
                <span class="badge">AVANZADO</span>
                <h2>3. Pivot Personalizado</h2>
                <p>Agrega lógica y datos extra a tablas intermedias.</p>
                <ul>
                    <li>Modelo Pivot custom</li>
                    <li>withPivot() avanzado</li>
                    <li>Métodos en el pivot</li>
                </ul>
                <a href="/ejemplos/eloquent/pivot">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🎯</div>
                <h2>4. Scopes Locales y Globales</h2>
                <p>Reutiliza queries complejas con scopes.</p>
                <ul>
                    <li>Scopes locales</li>
                    <li>Scopes globales</li>
                    <li>Combinar múltiples scopes</li>
                    <li>Scopes con parámetros</li>
                </ul>
                <a href="/ejemplos/eloquent/scopes">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">✨</div>
                <h2>5. Accessors y Mutators</h2>
                <p>Transforma datos al leer y escribir (sintaxis moderna).</p>
                <ul>
                    <li>Accessors modernos</li>
                    <li>Mutators modernos</li>
                    <li>Attribute casting</li>
                    <li>Computed properties</li>
                </ul>
                <a href="/ejemplos/eloquent/accessors-mutators">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🔍</div>
                <span class="badge">AVANZADO</span>
                <h2>6. Query Builder Avanzado</h2>
                <p>Queries complejas con subqueries y agregaciones.</p>
                <ul>
                    <li>Subqueries en SELECT</li>
                    <li>Subqueries en WHERE</li>
                    <li>Window functions</li>
                    <li>Agregaciones complejas</li>
                </ul>
                <a href="/ejemplos/eloquent/query-avanzado">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">⚡</div>
                <span class="badge">PERFORMANCE</span>
                <h2>7. Optimización e Indexación</h2>
                <p>Mejora el rendimiento de tus queries.</p>
                <ul>
                    <li>Índices en migraciones</li>
                    <li>EXPLAIN queries</li>
                    <li>Comparación de performance</li>
                    <li>Best practices</li>
                </ul>
                <a href="/ejemplos/eloquent/optimizacion">Ver Ejemplo →</a>
            </div>

            <div class="card">
                <div class="icon">🎮</div>
                <span class="badge">INTERACTIVO</span>
                <h2>8. Playground</h2>
                <p>Prueba queries de Eloquent en tiempo real.</p>
                <ul>
                    <li>Ejecuta código Eloquent</li>
                    <li>Ve las queries SQL</li>
                    <li>Mide el tiempo de ejecución</li>
                    <li>Experimenta libremente</li>
                </ul>
                <a href="/ejemplos/eloquent/playground">Abrir Playground →</a>
            </div>
        </div>

        <a href="/">← Volver al inicio</a>
    </div>
</body>
</html>
