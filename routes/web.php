<?php
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

Dusterio\LumenPassport\LumenPassport::routes($router);
$router->get('/', function () use ($router) {
    //return $router->app->version();
    return view ('teste');
});
$router->group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function () use ($router){
    $router->get('restaurants/by-address', 'RestaurantsController@getByAddress');
    $router->post('restaurants/vote', 'VotesController@store');
    $router->get('restaurants/{id:[0-9]+}/view-phone', 'RestaurantsController@viewPhone');
});
$router->group(['prefix' => 'api/v1', 'namespace' => 'Api\V1', 'middleware' => ['auth']], function () use ($router){
    $router->get('restaurants', 'RestaurantsController@index');
    $router->get('restaurants/{id:[0-9]+}', 'RestaurantsController@show');
    $router->post('restaurants', 'RestaurantsController@store');
    $router->put('restaurants/{id:[0-9]+}', 'RestaurantsController@update');
    $router->post('restaurants/{id:[0-9]+}', 'RestaurantsController@update');
    $router->delete('restaurants/{id:[0-9]+}', 'RestaurantsController@destroy');

    $router->post('restaurants/{id:[0-9]+}/address', 'RestaurantsController@address');
    $router->post('restaurants/{id:[0-9]+}/upload', 'RestaurantsController@upload');

    $router->get('restaurants/{id:[0-9]+}/photos', 'RestaurantPhotosController@index');
    $router->post('restaurants/photos', 'RestaurantPhotosController@store');
    $router->delete('restaurants/photos/{id:[0-9]+}', 'RestaurantPhotosController@destroy');

    $router->get('products', 'ProductsController@index');
    $router->get('products/{id:[0-9]+}', 'ProductsController@show');
    $router->post('products', 'ProductsController@store');
    $router->post('products/{id:[0-9]+}', 'ProductsController@update');
    $router->delete('products/{id:[0-9]+}', 'ProductsController@destroy');

    $router->get('auth/me', 'AuthController@me');
    $router->post('auth/change-password', 'AuthController@changePassword');
    $router->post('auth/edit-profile', 'AuthController@editProfile');
    $router->get('auth/logout', 'AuthController@logout');
});