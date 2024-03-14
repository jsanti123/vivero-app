<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViveroController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('vivero.index');
Route::get('/productores', [ProductorController::class, 'index'])->name('productor.index');
Route::get('/productores/{productor}', [ProductorController::class, 'show'])->name('productor.show');
Route::get('/fincas', [FincaController::class, 'index'])->name('finca.index');
Route::get('/fincas/{num_catastro}/{municipio}', [FincaController::class, 'show'])->name('finca.show');
Route::get('/fincas/vivero/labores/{codigo}', [FincaController::class, 'labores'])->name('finca.labores');
Route::get('/fincas/vivero/labores/{labor}/{codigo}', [FincaController::class, 'producto'])->name('finca.productos');
