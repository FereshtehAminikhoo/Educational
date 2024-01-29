<?php

Route::group(['namespace' => 'Course\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){
    $router->post('/seasons/{course}/store', 'SeasonController@store')->name('seasons.store');
    $router->get('/seasons/{season}/edit', 'SeasonController@edit')->name('seasons.edit');
    $router->patch('/seasons/{season}/update', 'SeasonController@update')->name('seasons.update');
    $router->delete('/seasons/{season}/delete', 'SeasonController@destroy')->name('seasons.destroy');
    $router->patch('/seasons/{season}/accept', 'SeasonController@accept')->name('seasons.accept');
    $router->patch('/seasons/{season}/reject', 'SeasonController@reject')->name('seasons.reject');
    $router->patch('/seasons/{season}/lock', 'SeasonController@lock')->name('seasons.lock');
    $router->patch('/seasons/{season}/unlock', 'SeasonController@unlock')->name('seasons.unlock');
});
