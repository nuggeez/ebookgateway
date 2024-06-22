<?php

// Defines the namespace for this middleware. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Middleware;

// Imports the Closure class from the global namespace. This class is used to handle closures.
use Closure;

// Imports the Auth factory interface from the Illuminate\Contracts\Auth namespace. This interface defines the contract for authentication factories.
use Illuminate\Contracts\Auth\Factory as Auth;

// Declares the Authenticate class, which is a middleware class that handles authentication.
class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth; // Declares a protected property named $auth to hold the authentication factory instance.

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth) // Defines the constructor method for this middleware.
    {
        $this->auth = $auth; // Within the constructor, assigns the injected Auth factory instance to the $auth property. This allows the middleware to use the authentication factory.
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) // Defines the handle method to process incoming requests.
    {
        if ($this->auth->guard($guard)->guest()) { // Checks if the user is a guest (not authenticated) for the specified guard.
            return response('Unauthorized.', 401); // If the user is not authenticated, returns a 401 Unauthorized response.
        }

        return $next($request); // If the user is authenticated, passes the request to the next middleware in the stack.
    }
}
