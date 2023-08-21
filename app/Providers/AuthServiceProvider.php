<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\job;
use App\Models\Space;
use App\Policies\TaskSpacePolicy;
use App\Policies\UserSpacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Space::class =>UserSpacePolicy::class,
        job::class =>TaskSpacePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
