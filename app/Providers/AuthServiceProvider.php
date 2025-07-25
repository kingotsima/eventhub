<?php

namespace App\Providers;

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
        \App\Models\Booking::class => \App\Policies\BookingPolicy::class,
    ];
    

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Gate::define('isAdmin', function ($user) {
        return $user->isAdmin();
        });
    }
}
