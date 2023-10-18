<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('services_delete', fn(User $user)=>$user->is_admin);
        Gate::define('services_edit', fn(User $user)=>$user->is_admin);
        Gate::define('services_add', fn(User $user)=>$user->is_admin);
        Gate::define('users_index', fn(User $user)=>$user->is_admin);
        Gate::define('requests_index', fn(User $user)=>$user->is_admin);
    }
}
