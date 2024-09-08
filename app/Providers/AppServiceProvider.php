<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Schema::defaultStringLength(191);
        if (explode(':', config('app.url'))[0] == 'https') {
            $this->app['request']->server->set('HTTPS', 'on');
            \URL::forceScheme('https');
        }

        view()->composer('layouts.components.nav','App\Http\Composer\LeftMenuComposer');
        view()->composer('layouts.topmenu','App\Http\Composer\TopMenuComposer');

        $modules =\Module::all();
        foreach ($modules as $module) {
            $this->loadMigrationsFrom([$module->getPath() . '/Database/Migrations']);
        }
    }
}
