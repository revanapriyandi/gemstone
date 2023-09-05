<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        if (config('app.env') === 'local') {
            URL::forceScheme('http');
        }
        if (Schema::hasTable('settings')) {
            $settings = Settings::findOrFail(1);
            View::composer('*', function ($view) use ($settings) {
                $view->with('settings', $settings);
            });
        }

        if (session('success')) {
            flash()->addSuccess(session('success'));
        }

        if (session('error')) {
            flash()->addError(session('error'));
        }

        if (session('warning')) {
            flash()->addWarning(session('warning'));
        }

        if (session('info')) {
            flash()->addInfo(session('info'));
        }
    }
}
