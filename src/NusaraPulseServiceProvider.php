<?php

declare(strict_types=1);

namespace Nusara\Pulse;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class NusaraPulseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('web')->group($this->loadRoutesFrom(__DIR__.'/Routes/web.php'));

        Route::group(['middleware' => ['api', InitializeTenancyByDomain::class], 'prefix' => 'api'], function () {
            $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        });

        $this->loadViewsFrom(__DIR__.'/Resources/Js/Pages', 'pulse');

        $this->publishes([
            __DIR__.'/Database/Migrations/' => database_path('migrations/tenant'),
        ], 'pulse-migrations');
    }
}
