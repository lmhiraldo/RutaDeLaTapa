<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        // //Le estamos dando permisos
        // Gate::define('tapa', function (User $user) {
        //     return $user->admin == User::ROLE_ADMINISTRATOR;
        // });

        // Gate::define('bars', function (User $user) {
        //     return $user->admin == User::ROLE_ADMINISTRATOR;
        // });
        // Gate::define('bar_tapa', function (User $user) {
        //     return $user->admin == User::ROLE_ADMINISTRATOR;
        // });       
        
        // Gate::define('vote-tapa', function (User $user) {
        //     return $user->admin == User::ROLE_USER;
        // });

        //
    }
}