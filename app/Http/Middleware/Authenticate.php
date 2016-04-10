<?php

namespace AC\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * @var Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param Factory $auth
     *
     * @return void
     */
    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request     $request
     * @param \Closure    $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
