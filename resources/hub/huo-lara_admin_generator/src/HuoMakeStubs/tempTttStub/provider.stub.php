<?php

namespace App\Providers;

use App\HttpTenancy\Middleware\Authenticate;
use App\HttpTenancy\Middleware\Bootstrap;
use App\HttpTenancy\Middleware\Pjax;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
class TenancyServiceProvider extends ServiceProvider
{


    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'tenancy.auth'       => Authenticate::class,
        'tenancy.pjax'       => Pjax::class,
//        'tenancy.permission' => Permission::class,
        'tenancy.bootstrap'  => Bootstrap::class,
//        'tenancy.verified' => TenancyEmailIsVerified::class,
//        'tenancy.rolechose' => Middleware\RoleChose::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'tenancy' => [
            'tenancy.auth',
            'tenancy.pjax',
            'tenancy.bootstrap',
//            'tenancy.permission',
        ],
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path("/vendor/encore/laravel-admin/resources/views"), 'tenancy');

        if (config('admin.https') || config('admin.secure')) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }

        if (file_exists($routes = app_path('HttpTenancy/routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        //remove default feature of double encoding enable in laravel 5.6 or later.
        $bladeReflectionClass = new \ReflectionClass('\Illuminate\View\Compilers\BladeCompiler');
        if ($bladeReflectionClass->hasMethod('withoutDoubleEncoding')) {
            Blade::withoutDoubleEncoding();
        }
//        dd(4);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAuthConfig();

        $this->registerRouteMiddleware();

    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAuthConfig()
    {
        config( Arr::dot(config('tenancy.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
