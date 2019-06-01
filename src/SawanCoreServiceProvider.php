<?php

namespace Sawan\Core;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Lara\Core\Commands\MigrateLaraCoreModels;

class SawanCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->make('Lara\Core\Controllers\BaseController');
        $this->app->make('Lara\Core\Controllers\AttachmentController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        /*if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateLaraCoreModels::class,
            ]);
        }*/
    }
}
