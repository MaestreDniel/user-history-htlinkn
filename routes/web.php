<?php

use App\Http\Controllers\OfferController;
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
    Route::controller(OfferController::class)->group(function () {
        Route::get('/offers', 'index')->name('offers');
        Route::get('/detail', 'detail')->name('detail');
        Route::get('/redeem/{code}', 'redeem_confirmation')->name('redeem_confirmation');
        Route::post('/offers', 'store_code')->name('store');
        Route::patch('/redeem/{code}', 'redeem_code')->name('redeem');
    });
});


require __DIR__.'/auth.php';
