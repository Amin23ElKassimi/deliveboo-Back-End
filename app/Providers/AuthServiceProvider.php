<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\RestaurantPolicy;
use App\Policies\FoodItemPolicy;
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
        Gate::define('edit-restaurant', [RestaurantPolicy::class, 'edit']);
        Gate::define('edit-foodItem', [FoodItemPolicy::class, 'edit']);

        Gate::define('update-restaurant', [RestaurantPolicy::class, 'update']);
        Gate::define('update-foodItem', [FoodItemPolicy::class, 'update']);
    }
}
