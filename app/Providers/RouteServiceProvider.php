<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

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

        $this->mapAdminApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapOrganizationApiRoutes();

        $this->mapOrganizationRoutes();
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
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
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

    protected function mapAdminRoutes()
    {
        Route::domain('admin.laravelvue.test')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapAdminApiRoutes()
    {
        Route::prefix('admin/api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin_api.php'));
    }

    protected function mapOrganizationApiRoutes()
    {
        Route::prefix('org/api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/org_api.php'));
    }

    protected function mapOrganizationRoutes()
    {
        Route::domain('org.laravelvue.test')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/organization.php'));

    }

}
