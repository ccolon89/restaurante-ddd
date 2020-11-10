<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Restaurante\Movimiento\Domain\IMovimientoRepository;
use Restaurante\Movimiento\Infrastructure\MovimientoEloquentRepository;
use Restaurante\Producto\Domain\IProductoSimpleRepository;
use Restaurante\Producto\Infrastructure\ProductoSimpleEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProductoSimpleRepository::class,ProductoSimpleEloquentRepository::class);
        $this->app->bind(IMovimientoRepository::class,MovimientoEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
