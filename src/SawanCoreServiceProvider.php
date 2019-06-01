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
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        /*if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateLaraCoreModels::class,
            ]);
        }*/
    }
}
