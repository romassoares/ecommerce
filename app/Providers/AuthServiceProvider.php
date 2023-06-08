<?php

namespace App\Providers;

use App\Models\Comprador;
use App\Models\User;
use App\Models\Vendedor;
use App\Policies\CompradorPolicy;
use App\Policies\UserPolicy;
use App\Policies\VendedorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comprador::class => CompradorPolicy::class,
        Vendedor::class => VendedorPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user_ven_and_adm', function (User $user) {
            return $user->type === 'ven' || $user->type === 'adm';
        });

        Gate::define('user_com_and_ven', function (User $user) {
            return $user->type === 'com' || $user->type === 'ven';
        });

        Gate::define('user_com_menu', function (User $user) {
            return $user->type === 'com';
        });

        Gate::define('user_adm_menu', function (User $user) {
            return $user->type === 'adm';
        });
        Gate::define('user_all', function (User $user) {
            return $user->type === 'adm' || $user->type === 'ven' || $user->type === 'com';
        });
    }
}
