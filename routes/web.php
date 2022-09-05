<?php

use App\Http\Controllers\OfertaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Es necesario tener un usuario logueado para usar todas las funcionalidades de la aplicación
 * ya que se controla todo con el middleware de auth.
 */ 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(OfertaController::class)->group(function () {
        Route::get('/ofertas', 'index')->name('ofertas');
        Route::get('/detalle', 'detalle')->name('detalle');
        Route::get('/canjeo/{codigo}', 'confirma_canjeo')->name('confirma_canjeo');
        Route::post('/ofertas', 'almacena_codigo')->name('almacenar');
        Route::patch('/canjeo/{codigo}', 'canjear_codigo')->name('canjear');
    });
});


require __DIR__.'/auth.php';
