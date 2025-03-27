<?php

namespace Henryy\Hoanghuynh;

use Illuminate\Support\ServiceProvider;

class QRCodePDFServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'package');

        // Load migrations nếu có
        // $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}
