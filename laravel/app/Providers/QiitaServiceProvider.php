<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\QiitaService;

class QiitaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('QiitaService', QiitaService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
