<?php

namespace App\Providers;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Route;
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
        /**
         * Bind product route param.
         */
        Route::bind('product', function ($value) {
            $product = Product::where(Product::CODE, $value)->first();

            if (empty($product)) {
                throw new Exception('Product not found"');
            }

            return $product;
        });
    }
}
