<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Obtener el idioma desde la sesión o usar 'en' por defecto
        $locale = Session::get('locale', 'en');

        // Establecer el idioma en la aplicación
        App::setLocale($locale);
    }
}
