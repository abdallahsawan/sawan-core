<?php

namespace Sawan\Core;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SawanCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->make('Sawan\Core\Controllers\BaseController');
        $this->app->make('Sawan\Core\Controllers\AttachmentController');
        $this->app->make('Sawan\Core\Controllers\PageController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__ . '/assets' => base_path('public'),
            __DIR__ . '/config' => config_path(),
            __DIR__ . '/resources' => base_path('resources'),
        ]);
        $this->loadViewsFrom(__DIR__ . '/resources/views');
        /*if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateLaraCoreModels::class,
            ]);
        }*/
    }
}
