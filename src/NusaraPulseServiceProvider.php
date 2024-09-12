<?php

declare(strict_types=1);

namespace Nusara\Pulse;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nusara\Pulse\Commands\NusaraPulseConsole;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class NusaraPulseServiceProvider extends ServiceProvider
{
    /**
     * Boots the Nusara Pulse package.
     *
     * This method is called during the application's boot process and can be used
     * to perform any necessary setup or initialization tasks for the Nusara Pulse
     * package.
     */
    public function boot()
    {
        $this->mapRoutes();
        $this->mapViews();
        $this->mapDatabase();
        $this->mapConsole();
    }

    /**
     * Maps the routes for the Nusara Pulse package.
     *
     * This method sets up the web and API routes for the Nusara Pulse package.
     * The web routes are loaded from the `Routes/web.php` file and are
     * middleware-protected with the `web` middleware.
     *
     * The API routes are loaded from the `Routes/api.php` file and are
     * middleware-protected with the `api` and `InitializeTenancyByDomain`
     * middleware. The API routes are also prefixed with `api`.
     */
    public function mapRoutes()
    {
        Route::middleware('web')->group($this->loadRoutesFrom(__DIR__.'/Routes/web.php'));

        Route::group(['middleware' => ['api', InitializeTenancyByDomain::class], 'prefix' => 'api'], function () {
            $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        });
    }

    /**
     * Loads the Nusara Pulse package's Vue.js components and pages.
     *
     * This method loads the Vue.js components and pages from the package's
     * `Resources/Js/Pages` directory, making them available to the application
     * under the `pulse` namespace.
     */
    public function mapViews()
    {
        $this->loadViewsFrom(__DIR__.'/Resources/Js/Pages', 'pulse');
    }

    /**
     * Publishes the database migration files for the Nusara Pulse package.
     *
     * This method publishes the database migration files from the package's
     * `Database/Migrations` directory to the application's `database/migrations/tenant`
     * directory, allowing the migrations to be run as part of the application's
     * database setup.
     */
    public function mapDatabase()
    {
        $this->publishes([
            __DIR__.'/Database/Migrations/' => database_path('migrations/tenant'),
        ], 'pulse-migrations');
    }

    /**
     * Register the Nusara Pulse console command.
     *
     * This method adds the NusaraPulseConsole command to the list of available Artisan commands.
     */
    public function mapConsole()
    {
        $this->commands([
            NusaraPulseConsole::class,
        ]);
    }
}
