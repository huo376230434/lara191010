<?php

namespace Encore\Admin\DBDiff;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class DBDiffServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(DBDiff $extension)
    {
        if (! DBDiff::boot()) {
            return ;
        }

        $this->loadViewsFrom($extension->views(), 'laravel-admin-db-diff');

        $this->registerPublishing();
        $this->registerRoutes();
        $this->registerAdminAssets();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-admin-ext/db-diff')
            ], 'laravel-admin-db-diff');
        }
    }

    /**
     * Register the package's builtin routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->app->booted(function () {
            DBDiff::routes(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register the package's assets from admin panel.
     *
     * @return void
     */
    protected function registerAdminAssets()
    {
        Admin::booting(function () {
            Admin::css('/vendor/laravel-admin-ext/db-diff/diff2html.min.css');
            Admin::js('/vendor/laravel-admin-ext/db-diff/diff2html.min.js');
        });
    }
}
