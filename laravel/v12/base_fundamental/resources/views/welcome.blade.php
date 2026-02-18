<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundamentos de Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        header {
            text-align: center;
            margin-bottom: 60px;
        }
        h1 { 
            font-size: 48px;
            font-weight: 600;
            color: #FF2D20;
            margin-bottom: 12px;
        }
        h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }
        .subtitle {
            font-size: 18px;
            color: #6b7280;
        }
        .info-box {
            background: #fff;
            border-left: 4px solid #FF2D20;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 4px;
        }
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 24px;
        }
        .card { 
            background: #fff;
            padding: 28px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            transition: box-shadow 0.2s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .icon {
            font-size: 36px;
            margin-bottom: 16px;
        }
        .card h2 { 
            font-size: 20px;
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
        }
        .card li {
            margin: 8px 0;
        }
        .card a { 
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .card a:hover {
            color: #e02615;
        }
        .card small {
            color: #9ca3af;
            font-size: 13px;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 14px;
            color: #FF2D20;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Fundamentos de Laravel</h1>
            <p class="subtitle">Aprende los conceptos básicos con ejemplos prácticos</p>
        </header>
        
        <div class="info-box">
            <strong>📚 Guía de Aprendizaje:</strong> Cada sección contiene ejemplos interactivos y explicaciones detalladas. 
            Sigue el orden sugerido para una mejor comprensión.
        </div>
        
        <div class="grid">
            <div class="card">
                <div class="icon">📝</div>
                <h2>1. Variables</h2>
                <p>Aprende a trabajar con diferentes tipos de variables en Laravel y Blade.</p>
                <ul>
                    <li><a href="/ejemplos/variables/basicas">→ Variables Básicas</a></li>
                    <li><a href="/ejemplos/variables/arrays">→ Arrays</a></li>
                    <li><a href="/ejemplos/variables/request">→ Variables desde Request</a></li>
                </ul>
            </div>
            
            <div class="card">
                <div class="icon">⚙️</div>
                <h2>2. Funciones</h2>
                <p>Cómo crear y usar funciones en controladores para organizar tu código.</p>
                <ul>
                    <li><a href="/ejemplos/funciones">→ Funciones en Controladores</a></li>
                </ul>
            </div>
            
            <div class="card">
                <div class="icon">🗄️</div>
                <h2>3. Modelos (Eloquent ORM)</h2>
                <p>Interactúa con la base de datos usando el ORM de Laravel.</p>
                <ul>
                    <li><a href="/ejemplos/productos">→ CRUD Completo</a></li>
                    <li><a href="/ejemplos/productos/create">→ Crear Producto</a></li>
                </ul>
                <p><small>Conceptos: Fillable, Casts, Accessors, Mutators, Scopes</small></p>
            </div>
            
            <div class="card">
                <div class="icon">🎮</div>
                <h2>4. Controladores</h2>
                <p>Maneja la lógica de tu aplicación y conecta rutas con vistas.</p>
                <ul>
                    <li><a href="/ejemplos/productos">→ Resource Controller</a></li>
                </ul>
                <p><small>Métodos: index, create, store, show, edit, update, destroy</small></p>
            </div>
            
            <div class="card">
                <div class="icon">🛣️</div>
                <h2>5. Rutas (Routes)</h2>
                <p>Define los endpoints de tu aplicación.</p>
                <p><strong>Tipos de rutas:</strong></p>
                <ul>
                    <li>GET: <code>/ejemplos</code></li>
                    <li>POST: <code>/productos</code></li>
                    <li>Resource: <code>Route::resource()</code></li>
                    <li>Named Routes: <code>route('nombre')</code></li>
                </ul>
                <p><small>Ver: routes/web.php</small></p>
            </div>
            
            <div class="card">
                <div class="icon">🔧</div>
                <h2>6. Services</h2>
                <p>Separa la lógica de negocio en clases reutilizables.</p>
                <ul>
                    <li><a href="/ejemplos/servicios/estadisticas">→ Estadísticas</a></li>
                    <li><a href="/ejemplos/servicios/stock-bajo">→ Stock Bajo</a></li>
                    <li><a href="/ejemplos/servicios/buscar?q=">→ Búsqueda</a></li>
                </ul>
                <p><small>Conceptos: Inyección de dependencias, Service Container</small></p>
            </div>
        </div>

        <h2 style="margin-top: 60px; margin-bottom: 24px; font-size: 32px; color: #1f2937;">🚀 Conceptos Avanzados</h2>
        
        <div class="grid">
            <div class="card">
                <div class="icon">🏭</div>
                <h2>7. Factory y Seeder</h2>
                <p>Genera datos de prueba automáticamente para desarrollo y testing.</p>
                <ul>
                    <li><a href="/ejemplos/avanzados/factory-seeder">→ Ver Ejemplos</a></li>
                </ul>
                <p><small>Conceptos: Faker, Estados, Seeders, Testing</small></p>
            </div>

            <div class="card">
                <div class="icon">🌐</div>
                <h2>8. API REST</h2>
                <p>Crea endpoints para consumir desde aplicaciones externas.</p>
                <ul>
                    <li><a href="/ejemplos/avanzados/api">→ Ver Documentación</a></li>
                    <li><a href="/api/productos" target="_blank">→ Probar API</a></li>
                </ul>
                <p><small>Conceptos: JSON, HTTP Methods, Status Codes, Validación</small></p>
            </div>

            <div class="card">
                <div class="icon">⚡</div>
                <h2>9. Jobs y Queues</h2>
                <p>Ejecuta tareas pesadas en segundo plano sin bloquear al usuario.</p>
                <ul>
                    <li><a href="/ejemplos/avanzados/jobs-queues">→ Ver Ejemplos</a></li>
                </ul>
                <p><small>Conceptos: Async, Workers, Drivers, Supervisor</small></p>
            </div>
        </div>
    </div>
</body>
</html>
