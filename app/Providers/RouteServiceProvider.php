<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $SiteNamespace = 'App\Http\Controllers';
    protected $AdminNamespace = 'App\Http\Controllers\Admin';
    protected $UserNamespace = 'App\Http\Controllers\User';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/user'; // User
    public const ADMIN_HOME = '/admin'; // Admin

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapUserRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale())
            ->namespace($this->SiteNamespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'auth' , 'role:super_admin|admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->AdminNamespace)
            ->group(base_path('routes/admin.php'));
    }


    protected function mapUserRoutes()
    {
        Route::middleware(['web', 'auth' , 'role:user', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale() . '/user')
            ->as('user.')
            ->namespace($this->UserNamespace)
            ->group(base_path('routes/user.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
