<?php

Route::group(['namespace' => 'Category\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){
    $router->resource('/categories', 'CategoryController');
});
