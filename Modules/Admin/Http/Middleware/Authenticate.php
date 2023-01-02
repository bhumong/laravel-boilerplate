<?php

namespace Modules\Admin\Http\Middleware;

use App;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Admin\Services\Rbac\Rbac;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('admin/login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        /** @var Rbac */
        $rbac = App::make(Rbac::class);
        $rbac->generate();
        return parent::authenticate($request, $guards);
    }
}
