<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/product', 'ProductController@index');
$router->get('/product/{id}', 'ProductController@show');
$router->post('/product', 'ProductController@create');
$router->put('/product/{id}', 'ProductController@update');
$router->delete('/product/{id}', 'ProductController@delete');

// transaction/inventory
$router->get('/transaction', 'TransactionController@index');
$router->get('/transaction/{id}', 'TransactionController@show');
$router->post('/transaction', 'TransactionController@create');

