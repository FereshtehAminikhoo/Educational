<?php

Route::group(['namespace' => 'Course\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){
    $router->patch('/seasons/{season}/accept', 'SeasonController@accept')->name('seasons.accept');
    $router->patch('/seasons/{season}/reject', 'SeasonController@reject')->name('seasons.reject');
    $router->post('/seasons/{course}', 'SeasonController@store')->name('seasons.store');
    $router->get('/seasons/{season}/edit', 'SeasonController@edit')->name('seasons.edit');
    $router->patch('/seasons/{season}/update', 'SeasonController@update')->name('seasons.update');
});
