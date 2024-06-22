<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Root route returning the application version
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Grouping routes with 'client.credentials' middleware
$router->group(['middleware' => 'client.credentials'], function () use ($router) {

    // Routes for interacting with BookFinderController
    $router->get('/search', 'BookFinderController@searchBooks');

    // Routes for interacting with AllBooksApiController
    $router->get('/get-book', 'AllBooksApiController@search');

    // Routes for interacting with MyAnimeListController
    $router->get('/manga-reco', 'MyAnimeListController@getMangaRecommendations');
    $router->get('/details/{id}', 'MyAnimeListController@getMangaDetails');

    // User routes
    $router->get('/users', 'UserController@index');
    $router->get('/users/{id}', 'UserController@show');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@delete');

    // Authentication log routes
    $router->get('/logs', 'AuthenticationLogController@index');
    $router->get('/logs/{id}', 'AuthenticationLogController@show');
    $router->delete('/logs/{id}', 'AuthenticationLogController@delete');
    $router->post('/logs', 'AuthenticationLogController@add');
});

// Route for adding a new user
$router->post('/users', 'UserController@add');
