<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Receipt;
use App\Policies\CountryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\ReceiptPolicy;
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
        SmsLog::class => SMSLogPolicy::class,
        Country::class => CountryPolicy::class,
        Customer::class => CustomerPolicy::class,
        Receipt::class => ReceiptPolicy::class,
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
