<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($user = $this->auth->guard($guard)->user())
        {
            $vfConfig = config('vodafone');
            $scopes = explode(' ', $user->token->scope);
            if(!in_array($vfConfig['allowed_keycloak_scope'], $scopes))
            {
                return response('User doesnt have '.$vfConfig['allowed_keycloak_scope'].' scope', 401)->header('content-type', 'application/json');
            }
        }

        if ($this->auth->guard($guard)->guest()) {
            $error['error'] = 'Unauthorized, please use the valid bearer token';

            return response($error, 401)->header('content-type', 'application/json');
        }

        return $next($request);
    }
}
