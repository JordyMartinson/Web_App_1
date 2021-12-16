<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        Post::class=> PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('loggedIn', function ($user) {
            return ($user->hasRoles(['Admin', 'User']));
        });

        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('Admin');
        });
        
        Gate::define('isUser', function ($user) {
            return $user->hasRole('User');
        });

        Gate::define('ownsComment', [CommentPolicy::class, 'ownsComment']);
        Gate::define('ownsPost', [PostPolicy::class, 'ownsPost']);
    }
}
