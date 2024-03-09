<?php 

namespace Mkhodroo\AltfuelTicket;

use Illuminate\Support\ServiceProvider;

class AltfuelTicketServiceProvider extends ServiceProvider{
    public function register()
    {

    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('ATConfig.php')
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__. '/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'ATView');
        // $this->loadMigrationsFrom(__DIR__ .'src/migrations');
    }
}
