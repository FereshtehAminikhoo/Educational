<?php

Route::group(['namespace' => 'Front\Http\Controllers', 'middleware' => ['web']], function($router){
    $router->get('/', 'FrontController@index');
    $router->get('/c-{slug}', 'FrontController@singleCourse')->name('singleCourse');
});
