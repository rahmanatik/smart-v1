<?php



/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;

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

//TODO:: delete me
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => '/api'], function () use ($router) {
    $router->post('/users', 'UserController@create');
    $router->delete('/users/{id}', 'UserController@delete');
    $router->put('/users/{id}', 'UserController@update');
    $router->get('/users', 'UserController@findAll');
    $router->get('/users/{id}', 'UserController@findById');

    $router->post('/customers', 'CustomerController@create');
    $router->delete('/customers/{id}', 'CustomerController@delete');
    $router->put('/customers/{id}', 'CustomerController@update');
    $router->get('/customers', 'CustomerController@findAll');
    $router->get('/customers/{id}', 'CustomerController@findById');

    $router->post('/items', 'ItemController@create');
    $router->delete('/items/{id}', 'ItemController@delete');
    $router->put('/items/{id}', 'ItemController@update');
    $router->get('/items', 'ItemController@findAll');
    $router->get('/items/{id}', 'ItemController@findById');
    $router->get('/items_details', 'ItemController@findAllDetails');
    // $router->get('/items_details/{id}', 'ItemController@findDetailsById');
    $router->get('/items_details/item_name', 'ItemController@findDetailsByName');

    $router->post('/images', 'ImageController@create');
    $router->delete('/images/{id}', 'ImageController@delete');
    $router->put('/images/{id}', 'ImageController@update');
    $router->get('/images', 'ImageController@findAll');
    $router->get('/images/{id}', 'ImageController@findById');

    $router->post('categories', 'CategoryController@create');
    $router->delete('categories/{id}', 'CategoryController@delete');
    $router->put('categories/{id}', 'CategoryController@update');
    $router->get('/categories', 'CategoryController@findAll');
    $router->get('categories/{id}', 'CategoryController@findById');
});
