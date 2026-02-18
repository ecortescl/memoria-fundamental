# Laravel 12 - Guía Completa de Aprendizaje

> Proyecto académico diseñado para enseñar Laravel desde fundamentos hasta conceptos profesionales avanzados.

## 📚 Descripción

Este proyecto es una guía educativa completa de Laravel 12 que cubre desde los conceptos básicos hasta técnicas profesionales utilizadas en producción. Cada sección incluye ejemplos prácticos, código comentado y explicaciones detalladas.

## 🎯 Objetivo Académico

Proporcionar una ruta de aprendizaje estructurada que permita a desarrolladores:
- Dominar los fundamentos de Laravel
- Comprender patrones de arquitectura limpia
- Aplicar mejores prácticas de seguridad
- Optimizar aplicaciones para producción
- Implementar flujos de trabajo DevOps

## 🚀 Requisitos

- PHP 8.3 o superior
- Composer
- SQLite (incluido en el proyecto)
- Node.js y NPM (opcional, para assets)

## 📦 Instalación

```bash
# Clonar el repositorio
git clone <repository-url>
cd laravel/v12/base_fundamental

# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Ejecutar migraciones y seeders
php artisan migrate --seed

# Iniciar servidor de desarrollo
php artisan serve
```

Acceder a: `http://localhost:8000`

## 📖 Estructura del Curso

### 🟢 Nivel Básico (Secciones 1-6)

#### 1. Variables y Tipos de Datos
- Variables básicas en PHP y Blade
- Arrays y colecciones
- Variables desde Request
- **Ubicación**: `/ejemplos/variables/*`

#### 2. Funciones
- Funciones en controladores
- Helpers personalizados
- Organización de código
- **Ubicación**: `/ejemplos/funciones`

#### 3. Modelos (Eloquent ORM)
- Definición de modelos
- Fillable y guarded
- Casts, accessors y mutators
- Scopes básicos
- **Ubicación**: `/ejemplos/productos`

#### 4. Controladores
- Resource Controllers
- CRUD completo
- Validación de datos
- Respuestas HTTP
- **Ubicación**: `app/Http/Controllers/ProductosController.php`

#### 5. Rutas
- Rutas básicas (GET, POST, PUT, DELETE)
- Route groups
- Named routes
- Resource routes
- **Ubicación**: `routes/web.php`

#### 6. Services
- Service Layer Pattern
- Inyección de dependencias
- Service Container
- Separación de lógica de negocio
- **Ubicación**: `/ejemplos/servicios/*`

### 🟡 Nivel Avanzado (Secciones 7-9)

#### 7. Factory y Seeder
- Model Factories
- Estados de factory
- Database Seeders
- Datos de prueba
- **Ubicación**: `/ejemplos/avanzados/factory-seeder`

#### 8. API REST
- Endpoints RESTful
- JSON responses
- Validación de API
- Status codes HTTP
- **Ubicación**: `/ejemplos/avanzados/api`

#### 9. Jobs y Queues
- Procesamiento asíncrono
- Queue workers
- Job chaining
- Failed jobs
- **Ubicación**: `/ejemplos/avanzados/jobs-queues`

### 🔴 Nivel Profesional (Secciones 10-15)

#### 10. Eloquent Avanzado
**Conceptos cubiertos:**
- Relaciones complejas (1:1, 1:N, N:M)
- Eager Loading y N+1 Problem
- Relaciones polimórficas
- Pivot tables personalizadas
- Scopes locales y globales
- Accessors y Mutators modernos
- Query Builder avanzado
- Subqueries y agregaciones
- Optimización de queries
- **Playground interactivo** para probar queries en tiempo real

**Ubicación**: `/ejemplos/eloquent/*`

**Archivos clave:**
- `app/Models/Producto.php` - Modelo con relaciones
- `app/Models/Categoria.php` - Relación 1:N
- `app/Models/Etiqueta.php` - Relación N:M
- `app/Models/Imagen.php` - Relación polimórfica
- `database/seeders/EloquentAvanzadoSeeder.php`

#### 11. Arquitectura Limpia
**Conceptos cubiertos:**
- Principios SOLID
- DTOs (Data Transfer Objects)
- Form Requests
- Actions (Single Responsibility)
- Services (Coordinación)
- Repositories (Abstracción de datos)
- Policies (Autorización)
- Controllers limpios
- Comparación código malo vs bueno

**Ubicación**: `/ejemplos/arquitectura/*`

**Archivos clave:**
- `app/DataTransferObjects/ProductoDTO.php`
- `app/Http/Requests/StoreProductoRequest.php`
- `app/Actions/CrearProductoAction.php`
- `app/Services/ProductoService.php`
- `app/Repositories/ProductoRepository.php`
- `app/Policies/ProductoPolicy.php`

#### 12. Testing
**Conceptos cubiertos:**
- PHPUnit vs Pest
- Feature Tests (integración)
- Unit Tests (unitarios)
- Mocking y Fakes
- Testing de Jobs
- Testing de Events
- Testing de APIs
- TDD (Test-Driven Development)
- Cobertura de código

**Ubicación**: `/ejemplos/testing/*`

**Comandos útiles:**
```bash
php artisan test
php artisan test --filter ProductoTest
php artisan test --coverage
```

#### 13. Seguridad 🔒
**Conceptos cubiertos:**
- CSRF Protection
- XSS Prevention
- SQL Injection Protection
- Mass Assignment Protection
- Hashing de contraseñas (Bcrypt)
- Encriptación de datos
- Rate Limiting
- Validaciones robustas
- Storage seguro

**Ubicación**: `/ejemplos/seguridad/*`

**Archivos clave:**
- `app/Http/Controllers/SeguridadController.php`
- Ejemplos prácticos de vulnerabilidades y soluciones

#### 14. Performance y Escalabilidad ⚡
**Conceptos cubiertos:**
- Cache (Redis, Memcached)
- Query Optimization
- Lazy Collections
- Laravel Horizon
- Laravel Octane
- Config y Route Cache
- Docker para producción
- Load Balancing

**Ubicación**: `/ejemplos/performance/*`

**Comandos de optimización:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

#### 15. DevOps y Entorno Real 🚀
**Conceptos cubiertos:**
- Docker y Docker Compose
- CI/CD (GitHub Actions, GitLab CI)
- Git avanzado (rebase, cherry-pick, hooks)
- Deploy (Forge, Vapor, VPS, AWS)
- Logs (Monolog, canales)
- Monitoreo (Telescope, Sentry, New Relic, Pulse)

**Ubicación**: `/ejemplos/devops/*`

**Archivos clave:**
- Ejemplos de Dockerfile
- Configuraciones de CI/CD
- Scripts de deploy

## 🗂️ Estructura de Archivos

```
laravel/v12/base_fundamental/
├── app/
│   ├── Actions/                    # Acciones de negocio
│   ├── DataTransferObjects/        # DTOs
│   ├── Http/
│   │   ├── Controllers/            # Controladores
│   │   └── Requests/               # Form Requests
│   ├── Jobs/                       # Jobs asíncronos
│   ├── Models/                     # Modelos Eloquent
│   ├── Policies/                   # Políticas de autorización
│   ├── Repositories/               # Repositorios
│   └── Services/                   # Servicios
├── database/
│   ├── factories/                  # Model Factories
│   ├── migrations/                 # Migraciones
│   └── seeders/                    # Seeders
├── resources/
│   └── views/
│       └── ejemplos/               # Vistas educativas
│           ├── variables/
│           ├── funciones/
│           ├── productos/
│           ├── servicios/
│           ├── avanzados/
│           ├── eloquent/
│           ├── arquitectura/
│           ├── testing/
│           ├── seguridad/
│           ├── performance/
│           └── devops/
└── routes/
    ├── web.php                     # Rutas web
    └── api.php                     # Rutas API
```

## 🎓 Ruta de Aprendizaje Recomendada

### Para Principiantes
1. Variables → Funciones → Modelos → Controladores → Rutas → Services
2. Factory/Seeder → API REST → Jobs/Queues

### Para Desarrolladores Intermedios
1. Eloquent Avanzado (relaciones, optimización)
2. Arquitectura Limpia (patrones de diseño)
3. Testing (TDD, mocking)

### Para Desarrolladores Avanzados
1. Seguridad (vulnerabilidades comunes)
2. Performance (optimización, cache)
3. DevOps (deploy, monitoreo)

## 📊 Base de Datos

El proyecto utiliza SQLite con datos de ejemplo:
- 8 Productos
- 5 Categorías
- 5 Etiquetas
- 27 Imágenes (polimórficas)
- Relaciones N:M con pivot personalizada

**Resetear base de datos:**
```bash
php artisan migrate:fresh --seed
```

## 🔧 Comandos Útiles

```bash
# Desarrollo
php artisan serve                    # Servidor de desarrollo
php artisan tinker                   # REPL interactivo

# Base de datos
php artisan migrate                  # Ejecutar migraciones
php artisan migrate:fresh --seed    # Resetear y sembrar
php artisan db:seed                  # Solo seeders

# Cache
php artisan cache:clear              # Limpiar cache
php artisan config:clear             # Limpiar config cache
php artisan route:clear              # Limpiar route cache
php artisan view:clear               # Limpiar view cache

# Testing
php artisan test                     # Ejecutar tests
php artisan test --coverage          # Con cobertura

# Queues
php artisan queue:work               # Procesar jobs
php artisan queue:failed             # Ver jobs fallidos
```

## 🎯 Características Destacadas

### Playground Interactivo
Ubicado en `/ejemplos/eloquent/playground`, permite ejecutar queries Eloquent en tiempo real y ver:
- Resultado de la query
- SQL generado
- Tiempo de ejecución
- Queries ejecutadas

### Ejemplos Comparativos
Cada sección incluye comparaciones de:
- ❌ Código malo (anti-patrones)
- ✅ Código bueno (mejores prácticas)
- 📊 Métricas de rendimiento

### Código Fuente Visible
Todas las vistas muestran el código fuente de:
- Controladores
- Modelos
- Services
- Migrations

## 📝 Notas Importantes

### Seguridad
- Este proyecto es **solo para fines educativos**
- El playground usa `eval()` y debe **deshabilitarse en producción**
- Algunos ejemplos muestran vulnerabilidades intencionalmente

### Performance
- SQLite es adecuado para desarrollo, no para producción
- Los ejemplos de cache requieren Redis para funcionar completamente
- Octane y Horizon requieren instalación adicional

## 🤝 Contribuciones

Este es un proyecto académico. Las contribuciones son bienvenidas:
1. Fork del proyecto
2. Crear rama feature (`git checkout -b feature/nueva-seccion`)
3. Commit cambios (`git commit -m 'feat: agregar nueva sección'`)
4. Push a la rama (`git push origin feature/nueva-seccion`)
5. Abrir Pull Request

## 📄 Licencia

Este proyecto es de uso académico y educativo.

## 👨‍💻 Autor

Proyecto creado con fines educativos para enseñar Laravel de forma práctica y profesional.

## 🔗 Recursos Adicionales

- [Documentación oficial de Laravel](https://laravel.com/docs)
- [Laracasts](https://laracasts.com) - Video tutoriales
- [Laravel News](https://laravel-news.com) - Noticias y artículos
- [Laravel Daily](https://laraveldaily.com) - Tips diarios

## 📞 Soporte

Para preguntas o problemas:
1. Revisar la documentación en cada sección
2. Consultar el código fuente de los ejemplos
3. Abrir un issue en el repositorio

---

**¡Feliz aprendizaje! 🚀**
