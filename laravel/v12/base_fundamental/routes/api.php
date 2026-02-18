<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas API de tu aplicación. Estas rutas son
| cargadas por el RouteServiceProvider y asignadas al grupo "api".
|
*/

// Rutas API de Productos
Route::prefix('productos')->group(function () {
    Route::get('/', [ProductoApiController::class, 'index']);
    Route::post('/', [ProductoApiController::class, 'store']);
    Route::get('/buscar', [ProductoApiController::class, 'buscar']);
    Route::get('/stock-bajo', [ProductoApiController::class, 'stockBajo']);
    Route::get('/{id}', [ProductoApiController::class, 'show']);
    Route::put('/{id}', [ProductoApiController::class, 'update']);
    Route::patch('/{id}', [ProductoApiController::class, 'update']);
    Route::delete('/{id}', [ProductoApiController::class, 'destroy']);
});
