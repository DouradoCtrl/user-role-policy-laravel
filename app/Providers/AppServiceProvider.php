<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('admin.only', function ($user) {
            return $user->role === 'Administrador';
        });

        Gate::define('estoque', function ($user) {
            return in_array($user->role, ['Estoque', 'Administrador']);
        });

        Gate::define('atendente', function ($user) {
            return $user->role === 'Atendente' || $user->role === 'Administrador';
        });
    }
}