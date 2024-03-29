<?php

namespace App\Providers;

use App\Models\Forum;
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

        Gate::define('only-auth', function ($user, $id) {
            return $user->id == $id;
        });
        
        Gate::define('admin', function ($user) {
            return $user->role_id == 1;
        });
        
        Gate::define('editor', function ($user) {
            return $user->role_id == 2;
        });
        
        Gate::define('agent', function ($user) {
            return $user->role_id == 3;
        });
        
        Gate::define('user', function ($user, Forum $forum) {
            return $user->role_id == 4 && $user->id === $forum->user_id || $user->role_id == 1;
        });

    }
}
