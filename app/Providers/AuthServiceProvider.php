<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isDirector',function($user){
            return $user->type === 'director';
        });

        Gate::define('isFortisDirector',function($user){
            return $user->type === 'fortis_director';
        });

        Gate::define('isCoordinator',function($user){
            return $user->type === 'coordinator';
        });

        Gate::define('isAnalyst',function($user){
            return $user->type === 'analyst';
        });

        Gate::define('isINL',function($user){
            return $user->type === 'inl';
        });

        Passport::routes();
        //
    }
}
