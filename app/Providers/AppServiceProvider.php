<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Post::class => PostPolicy::class
    ];

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
        //
        // Gate::define('update-post', [PostPolicy::class, 'update']);
        // Gate::define('update-post', function () {
        //     return true;
        // });

        Gate::define('update-post', function (User $user = null) {
            return true;
        });
    }
}
