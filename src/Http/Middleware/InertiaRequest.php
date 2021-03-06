<?php

namespace RippleAdmin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class InertiaRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Inertia::setRootView('ripple-admin::layout');

        Inertia::share([
            'app' => function () {
                return [
                    'name' => Config::get('ripple.name'),
                ];
            },
            'url' => function () {
                return [
                    'prefix' => Config::get('ripple.prefix'),
                ];
            },
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        return $next($request);
    }
}
