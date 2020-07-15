<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', function ($user) {
            return ($user->role == 'admin');
        });
        // 管理者以上（管理者＆システム管理者）に許可
        Gate::define('shop-only', function ($user) {
            return ($user->role == 'shop');
        });
        // 一般ユーザ以上（つまり全権限）に許可
        Gate::define('user-only', function ($user) {
            return ($user->role == 'user');
        });
    }
}
