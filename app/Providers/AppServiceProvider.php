<?php

namespace App\Providers;

use App\Models\Mahasiswa; 
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $mahasiswas = Mahasiswa::all();
            $view->with('mahasiswas', $mahasiswas);
        });
    }
}
