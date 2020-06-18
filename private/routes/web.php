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
$crud = function () use ($router) {
    $router->post('/', 'Controller@create');
    $router->put('/{id}', 'Controller@edit');
    $router->delete('/{id}', 'Controller@delete');
    $router->get('/', 'Controller@list');
};
$router->group(['prefix' => 'books', 'namespace' => 'Books'], $crud);
$router->group(['prefix' => 'readers', 'namespace' => 'Readers'], $crud);
$router->group(['prefix' => 'loans', 'namespace' => 'Loans'], $crud);
