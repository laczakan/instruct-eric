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
    return $router->app->version();
});

// Route to get all services as a JSON
$router->get('/services', ['uses' => 'ServiceController@index']);
//  Route to get a service based on Country Code
$router->get('/services/{countryCode:[A-Za-z]{2}}', ['uses' => 'ServiceController@show']);

$router->post('/services', ['uses' => 'ServiceController@addOrUpdate']);

