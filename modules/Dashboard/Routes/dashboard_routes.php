<?php

Route::group(['namespace' => 'Dashboard\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){

         Route::get('/home', 'DashboardController@home')->name('home');

});

