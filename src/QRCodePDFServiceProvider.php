<?php

namespace Henryy\Hoanghuynh;

use Illuminate\Support\ServiceProvider;

class QRCodePDFServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes nếu có
        if (file_exists(__DIR__.'/../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }

        // Load views nếu có
        if (is_dir(__DIR__.'/../resources/views')) {
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'hoanghuynh');
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/hoanghuynh'),
            ], 'views');
        }

        // Load migrations nếu có
        if (is_dir(__DIR__.'/../database/migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        // Load cấu hình nếu có
        if (file_exists(__DIR__.'/../config/hoanghuynh.php')) {
            $this->publishes([
                __DIR__.'/../config/hoanghuynh.php' => config_path('hoanghuynh.php'),
            ], 'config');
        }
    }

    public function register()
    {
        // Merge config nếu package có file config
        if (file_exists(__DIR__.'/../config/hoanghuynh.php')) {
            $this->mergeConfigFrom(__DIR__.'/../config/hoanghuynh.php', 'hoanghuynh');
        }
    }
}
