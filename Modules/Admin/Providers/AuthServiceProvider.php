<?php

namespace Modules\Admin\Providers;

use App\Exceptions\ApiException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::setDefaultDriver('admin');

        // can be removed. it is useless because it same as default. it only serve for example
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            if (strpos($modelClass, 'Entities') !== false) {
                if (!class_exists($modelClass)) {
                    throw new ApiException(500, "Policy name guessing failed, [{$modelClass}] not a valid Entity");
                }
                $policyClass = str_replace('Entities', 'Policies', $modelClass) . 'Policy';
                if (!class_exists($policyClass)) {
                    throw new ApiException(500, "Policy name guessing failed, [{$policyClass}] not exists");
                }
                return $policyClass;
            }
            return null;
        });
    }
}
