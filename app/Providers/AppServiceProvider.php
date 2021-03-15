<?php

namespace App\Providers;

use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Product\ProductRepositoryInterface',
            'App\Repositories\Product\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\Review\ReviewRepositoryInterface',
            'App\Repositories\Review\ReviewRepository'
        );

        $this->app->bind(
            'App\Repositories\Cart\CartRepositoryInterface',
            'App\Repositories\Cart\CartRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductVariant\ProductVariantRepositoryInterface',
            'App\Repositories\ProductVariant\ProductVariantRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
    }
}
