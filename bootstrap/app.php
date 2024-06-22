<?php

require_once __DIR__.'/../vendor/autoload.php'; // This line includes Composer's autoloader, which loads all the dependencies for the application.

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap(); // Loads environment variables from .env file into the application. It's initializing environment settings based on the directory specified (dirname(__DIR__) resolves to the parent directory of the current script).

date_default_timezone_set(env('APP_TIMEZONE', 'UTC')); // Sets the default timezone for the application based on the APP_TIMEZONE environment variable from the .env file. If not specified, it defaults to UTC.

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/
// Creates a new instance of the Lumen application ($app) using Laravel\Lumen\Application. It specifies the base path (dirname(__DIR__), which is the parent directory of the current script) where the application files are located.
$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades(); // Enables the use of Laravel facades in the application. Facades provide a static interface to classes bound in the service container.

$app->withEloquent(); // Sets up the Eloquent ORM (Object-Relational Mapping) for database interactions. Eloquent is Laravel's ActiveRecord implementation.

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

// Binds the application's exception handler (App\Exceptions\Handler::class).
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

// Binds the console kernel (App\Console\Kernel::class), which handles console commands.
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('services'); // Loads the configuration file named services.php from the configuration directory.
$app->configure('auth'); // Loads the configuration file named auth.php.

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class, // Associates the 'auth' middleware with App\Http\Middleware\Authenticate::class.
    'client.credentials' => Laravel\Passport\Http\Middleware\CheckClientCredentials::class, //  Associates 'client.credentials' middleware with Laravel\Passport\Http\Middleware\CheckClientCredentials::class
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class); // Registers the application's authentication services.
// $app->register(App\Providers\EventServiceProvider::class);

$app->register(Laravel\Passport\PassportServiceProvider::class); // Registers Laravel Passport, which provides API authentication with OAuth2.
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class); // Enhances Lumen Passport functionality, which simplifies OAuth2 integration in Lumen.

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

// Loads the application's routes from web.php file located in the routes directory (__DIR__.'/../routes/web.php'). Routes are grouped under the App\Http\Controllers namespace.
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

//  returns the $app instance
return $app;
