<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class ApiMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Session Over Please Login Again.',
            $guards,
            $this->redirectTo($request)
        );
    }
}
