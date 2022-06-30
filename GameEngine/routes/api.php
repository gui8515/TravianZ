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
use App\Enums\TribeEnum;

$router->get('/', function () use ($router) {
    $tripes = TribeEnum::cases();

    var_dump($tripes);
});

// Routes for the User model
$router->get('/users', 'UserController@index');
$router->get('/users/villages', 'UserController@getUsersWithVillages');
$router->get('/users/building', 'UserController@getUsersWithBuildings');
$router->get('/users/units', 'UserController@getUsersWithUnits');

$router->get('/user/{id}/villages', 'UserController@getUserWithVillages');
$router->get('/user/{id}/{village_id}/buildings', 'UserController@showBuildings');
$router->get('/user/{id}/{village_id}/units', 'UserController@showUnits');

$router->get('/user/{id}', 'UserController@show');
$router->get('/user/{id}/{village_id}', 'UserController@showVillage');
$router->get('/user/{id}/{village_id}/{building_id}', 'UserController@showBuilding');
$router->get('/user/{id}/{village_id}/{unit_id}', 'UserController@showUnit');
