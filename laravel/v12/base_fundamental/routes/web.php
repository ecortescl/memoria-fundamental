<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VariablesController;
use App\Http\Controllers\FuncionesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\AvanzadosController;
use App\Http\Controllers\EloquentAvanzadoController;
use App\Http\Controllers\ArquitecturaController;

Route::get('/', function () {
    return view('welcome');
});

// Página principal de ejemplos
Route::get('/ejemplos', function () {
    return view('ejemplos.index');
});

// Rutas de Variables
Route::prefix('ejemplos/variables')->group(function () {
    Route::get('/basicas', [VariablesController::class, 'basicas']);
    Route::get('/arrays', [VariablesController::class, 'arrays']);
    Route::match(['get', 'post'], '/request', [VariablesController::class, 'desdeRequest']);
});

// Rutas de Funciones
Route::get('/ejemplos/funciones', [FuncionesController::class, 'index']);

// Rutas de Productos (Resource Controller - CRUD completo)
Route::resource('ejemplos/productos', ProductosController::class)->names([
    'index' => 'productos.index',
    'create' => 'productos.create',
    'store' => 'productos.store',
    'show' => 'productos.show',
    'edit' => 'productos.edit',
    'update' => 'productos.update',
    'destroy' => 'productos.destroy',
]);

// Rutas de Services
Route::prefix('ejemplos/servicios')->group(function () {
    Route::get('/estadisticas', [ServiciosController::class, 'estadisticas']);
    Route::get('/stock-bajo', [ServiciosController::class, 'stockBajo']);
    Route::get('/buscar', [ServiciosController::class, 'buscar']);
    Route::post('/descuento/{id}', [ServiciosController::class, 'aplicarDescuento']);
});

// Rutas de Ejemplos Avanzados
Route::prefix('ejemplos/avanzados')->group(function () {
    Route::get('/factory-seeder', [AvanzadosController::class, 'factorySeeder']);
    Route::get('/api', [AvanzadosController::class, 'api']);
    Route::get('/jobs-queues', [AvanzadosController::class, 'jobsQueues']);
    Route::post('/despachar-job', [AvanzadosController::class, 'despacharJob']);
});

// Rutas de Eloquent Avanzado
Route::prefix('ejemplos/eloquent')->group(function () {
    Route::get('/', [EloquentAvanzadoController::class, 'index']);
    Route::get('/relaciones', [EloquentAvanzadoController::class, 'relaciones']);
    Route::get('/polimorficas', [EloquentAvanzadoController::class, 'polimorficas']);
    Route::get('/pivot', [EloquentAvanzadoController::class, 'pivotPersonalizado']);
    Route::get('/scopes', [EloquentAvanzadoController::class, 'scopes']);
    Route::get('/accessors-mutators', [EloquentAvanzadoController::class, 'accessorsMutators']);
    Route::get('/query-avanzado', [EloquentAvanzadoController::class, 'queryAvanzado']);
    Route::get('/optimizacion', [EloquentAvanzadoController::class, 'optimizacion']);
    Route::match(['get', 'post'], '/playground', [EloquentAvanzadoController::class, 'playground']);
});

// Rutas de Arquitectura Limpia
Route::prefix('ejemplos/arquitectura')->group(function () {
    Route::get('/', [ArquitecturaController::class, 'index']);
    Route::get('/controller-limpio', [ArquitecturaController::class, 'controllerLimpio']);
    Route::get('/form-requests', [ArquitecturaController::class, 'formRequests']);
    Route::get('/dtos', [ArquitecturaController::class, 'dtos']);
    Route::get('/actions', [ArquitecturaController::class, 'actions']);
    Route::get('/services', [ArquitecturaController::class, 'services']);
    Route::get('/repositories', [ArquitecturaController::class, 'repositories']);
    Route::get('/policies', [ArquitecturaController::class, 'policies']);
    Route::get('/comparacion', [ArquitecturaController::class, 'comparacion']);
});

// Rutas de Testing
Route::prefix('ejemplos/testing')->group(function () {
    Route::get('/', [\App\Http\Controllers\TestingController::class, 'index']);
    Route::get('/introduccion', [\App\Http\Controllers\TestingController::class, 'introduccion']);
    Route::get('/phpunit-vs-pest', [\App\Http\Controllers\TestingController::class, 'phpunitVsPest']);
    Route::get('/feature-tests', [\App\Http\Controllers\TestingController::class, 'featureTests']);
    Route::get('/unit-tests', [\App\Http\Controllers\TestingController::class, 'unitTests']);
    Route::get('/mocking', [\App\Http\Controllers\TestingController::class, 'mocking']);
    Route::get('/jobs', [\App\Http\Controllers\TestingController::class, 'jobs']);
    Route::get('/events', [\App\Http\Controllers\TestingController::class, 'events']);
    Route::get('/apis', [\App\Http\Controllers\TestingController::class, 'apis']);
    Route::get('/tdd', [\App\Http\Controllers\TestingController::class, 'tdd']);
    Route::get('/cobertura', [\App\Http\Controllers\TestingController::class, 'cobertura']);
});

// Rutas de Seguridad
Route::prefix('ejemplos/seguridad')->group(function () {
    Route::get('/', [\App\Http\Controllers\SeguridadController::class, 'index']);
    Route::get('/csrf', [\App\Http\Controllers\SeguridadController::class, 'csrf']);
    Route::get('/xss', [\App\Http\Controllers\SeguridadController::class, 'xss']);
    Route::get('/sql-injection', [\App\Http\Controllers\SeguridadController::class, 'sqlInjection']);
    Route::get('/mass-assignment', [\App\Http\Controllers\SeguridadController::class, 'massAssignment']);
    Route::get('/hashing', [\App\Http\Controllers\SeguridadController::class, 'hashing']);
    Route::get('/encriptacion', [\App\Http\Controllers\SeguridadController::class, 'encriptacion']);
    Route::get('/rate-limiting', [\App\Http\Controllers\SeguridadController::class, 'rateLimiting']);
    Route::get('/validaciones', [\App\Http\Controllers\SeguridadController::class, 'validaciones']);
    Route::get('/storage', [\App\Http\Controllers\SeguridadController::class, 'storage']);
});

// Rutas de Performance
Route::prefix('ejemplos/performance')->group(function () {
    Route::get('/', [\App\Http\Controllers\PerformanceController::class, 'index']);
    Route::get('/cache', [\App\Http\Controllers\PerformanceController::class, 'cache']);
    Route::get('/query-optimization', [\App\Http\Controllers\PerformanceController::class, 'queryOptimization']);
    Route::get('/lazy-collections', [\App\Http\Controllers\PerformanceController::class, 'lazyCollections']);
    Route::get('/horizon', [\App\Http\Controllers\PerformanceController::class, 'horizon']);
    Route::get('/octane', [\App\Http\Controllers\PerformanceController::class, 'octane']);
    Route::get('/config-cache', [\App\Http\Controllers\PerformanceController::class, 'configCache']);
    Route::get('/docker', [\App\Http\Controllers\PerformanceController::class, 'docker']);
});

// Rutas de DevOps
Route::prefix('ejemplos/devops')->group(function () {
    Route::get('/', [\App\Http\Controllers\DevOpsController::class, 'index']);
    Route::get('/docker', [\App\Http\Controllers\DevOpsController::class, 'docker']);
    Route::get('/cicd', [\App\Http\Controllers\DevOpsController::class, 'cicd']);
    Route::get('/git', [\App\Http\Controllers\DevOpsController::class, 'git']);
    Route::get('/deploy', [\App\Http\Controllers\DevOpsController::class, 'deploy']);
    Route::get('/logs', [\App\Http\Controllers\DevOpsController::class, 'logs']);
    Route::get('/monitoreo', [\App\Http\Controllers\DevOpsController::class, 'monitoreo']);
});
