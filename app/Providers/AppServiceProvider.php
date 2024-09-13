<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        Gate::define('admin', function (User $user) {
            return in_array($user->name, ['yosr', 'yassine']);
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
