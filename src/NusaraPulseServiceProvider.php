<?php

declare(strict_types=1);

namespace Nusara\Pulse;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NusaraPulseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
            $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        });

        $this->loadViewsFrom(__DIR__.'/Resources/Js/Pages', 'pulse');
    }
}
