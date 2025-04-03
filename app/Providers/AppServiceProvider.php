<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        //gates en laravel
        Gate::define('ver-admin', function (User $user){
            return $user->rol === 'admin';
        });

        Gate::define('ver-ventas', function (User $user){
            return in_array($user->rol, ['admin', 'cajero']);
        });

    }
}
