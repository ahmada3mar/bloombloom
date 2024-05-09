<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Basket;
use App\Models\Frame;
use App\Models\Lens;
use App\Models\Price;
use App\Models\User;
use App\Policies\BasketPolicy;
use App\Policies\FramePolicy;
use App\Policies\LensPolicy;
use App\Policies\PricePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Price::class => PricePolicy::class,
        Lens::class => LensPolicy::class,
        Frame::class => FramePolicy::class,
        Basket::class => BasketPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
