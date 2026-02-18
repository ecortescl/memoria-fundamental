<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VariablesController;
use App\Http\Controllers\FuncionesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ServiciosController;

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
