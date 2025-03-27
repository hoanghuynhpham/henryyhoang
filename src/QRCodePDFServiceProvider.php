<?php

namespace Henryy\Hoanghuynh;

use Illuminate\Support\ServiceProvider;

class QRCodePDFServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish file cấu hình, nếu có
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__.'/../config/package.php' => config_path('package.php'),
            ], 'config');
        }

        // Load routes nếu có
        if (file_exists(__DIR__.'/../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }

        // Load views nếu có
        if (is_dir(__DIR__.'/../resources/views')) {
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'package');
        }

        // Load migrations nếu có
        if (is_dir(__DIR__.'/../database/migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    public function register()
    {
        // Merge cấu hình mặc định của package
        $this->mergeConfigFrom(__DIR__.'/../config/package.php', 'package');
    }
}
