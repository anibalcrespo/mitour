<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TipoActividadController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\InstanciaController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\PaymentController;
use App\Models\Instancia;

Route::get('/', function () {
    $instancias = Instancia::all();
    return view('welcome', compact('instancias'));
})->name('welcome');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Ruta para recursos tipo_actividades
    Route::resource('tipo_actividades', TipoActividadController::class);

    // Ruta para recursos actividades
    Route::resource('actividades', ActividadController::class);

    // Ruta para recursos instancias
    Route::resource('instancias', InstanciaController::class)->except(['show']);;

    // logout       
    Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

    //Get Payments
    Route::get('payments/{instancia_id}', [PaymentController::class, 'get_payments'])->name('get_payments');
});

Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);

Route::get('/instancias/{id}', [InstanciaController::class, 'show'])->name('instancia.show');

// Rutas de restablecimiento de contraseña
Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset']);

// MP
Route::post('process_payment', [PaymentController::class, 'process_payment']);

//Laguague Google Translate
Route::get('/set-language/{lang}', [LanguageController::class, 'setLanguage']);
Route::post('/translate', [LanguageController::class, 'translate']);