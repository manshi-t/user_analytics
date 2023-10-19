<?php

namespace Mansi\Analytics\Providers;

use Illuminate\Support\ServiceProvider;

class AnalyticsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../views', 'analytics');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../config/analysis.php' =>  config_path('analysis.php'),
        ], 'analysis');
        $this->publishes([
            __DIR__.'/../config/ignoreUrl.php' =>  config_path('ignoreUrl.php'),
        ], 'analysis');
        $this->publishes([
            __DIR__.'/../js/analytics.js' =>  public_path('js/analytics.js'),
        ], 'analysis');
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/analysis.php','analysis');
        $this->mergeConfigFrom(__DIR__.'/../config/ignoreUrl.php','ignoreUrl');
    }
}
