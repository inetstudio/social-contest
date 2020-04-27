<?php

namespace InetStudio\SocialContest\Prizes\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract' => \InetStudio\SocialContest\Prizes\Policies\PrizeModelPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
