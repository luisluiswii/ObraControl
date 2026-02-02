<?php

namespace App\Providers;

use App\Repositories\AsignacionRepository;
use App\Repositories\AsignacionRepositoryInterface;
use App\Repositories\FichajeRepository;
use App\Repositories\FichajeRepositoryInterface;
use App\Repositories\ObraRepository;
use App\Repositories\ObraRepositoryInterface;
use App\Repositories\TrabajadorRepository;
use App\Repositories\TrabajadorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding del repositorio para inyección de dependencias
        $this->app->bind(
            TrabajadorRepositoryInterface::class,
            TrabajadorRepository::class
        );

        $this->app->bind(
            ObraRepositoryInterface::class,
            ObraRepository::class
        );

        $this->app->bind(
            AsignacionRepositoryInterface::class,
            AsignacionRepository::class
        );

        $this->app->bind(
            FichajeRepositoryInterface::class,
            FichajeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
