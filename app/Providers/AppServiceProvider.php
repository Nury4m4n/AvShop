<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();

        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }

        Gate::define('admin', function (User  $user) {
            return $user->is_admin;
        });
        Gate::define('user', function (User  $user) {
            return !$user->is_admin;
        });
    }
}
