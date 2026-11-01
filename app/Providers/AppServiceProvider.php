<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('solo-admin' , function(user $user){
            return $user->Admin == 1;
        });


        Gate::define('solo-registrado' , function(user $user){
            return $user->Admin !== 1;
        });
    }
}
