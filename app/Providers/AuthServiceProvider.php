<?php

// Defines the namespace for this service provider. It helps in organizing and grouping classes logically within the application.
namespace App\Providers;

// Imports necessary classes from Laravel and Lumen frameworks.
use App\Models\User; // Import the User model.
use Illuminate\Support\Facades\Gate; // Facade for working with gates and policies.
use Illuminate\Support\ServiceProvider; // Base service provider class.
use Dusterio\LumenPassport\LumenPassport; // Lumen Passport package for API authentication.

// Declares the AuthServiceProvider class, which extends Laravel's base ServiceProvider class.
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // This method is typically used for registering services into the service container. 
        // It's often left empty in Lumen applications unless you need to register specific services.
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        // Example of using viaRequest method to authenticate users based on API token.
        /*
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
        */

        // Registers routes for Lumen Passport package.
        LumenPassport::routes($this->app->router);
    }
}
