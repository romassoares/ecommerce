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
    }
}
