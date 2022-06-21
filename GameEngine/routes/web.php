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

$router->get('/', function () use ($router) {
    $host = request()->getHttpHost();
    $router->app->version();
    return $host;
});

// Rourtes for the UserController
$router->get('/users', 'UserController@index');
$router->get('/users-villages', 'UserController@getUsersWithVillages');
$router->get('/user/{username}', 'UserController@show');

$router->get('/user/{username}/villages', 'UserController@getVillages');
$router->get('/user/{username}/village/{villageId}', 'UserController@getVillage');

$router->get('/user/{username}/village/{villageId}/units', 'UserController@getUnits');
