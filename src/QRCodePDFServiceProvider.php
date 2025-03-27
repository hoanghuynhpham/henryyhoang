<?php

namespace Henryy\Hoanghuynh;

use Illuminate\Support\ServiceProvider;

class QRCodePDFServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load route từ package
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load views từ package
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'package');

        // Publish view để người dùng có thể override nếu muốn
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/package'),
        ], 'views');
    }

    public function register()
    {
        //
    }
}
