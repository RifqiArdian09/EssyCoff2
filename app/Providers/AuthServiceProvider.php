<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('access-cashier', function ($user) {
            return $user->role === 'kasir';
        });
    }
}