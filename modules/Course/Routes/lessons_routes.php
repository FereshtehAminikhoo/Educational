<?php

Route::group(['namespace' => 'Course\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){
    $router->get('/courses/{course}/lessons/create', 'LessonController@create')->name('lessons.create');
    $router->post('/courses/{course}/lessons/store', 'LessonController@store')->name('lessons.store');
    $router->get('/courses/{course}/lessons/{lesson}/edit', 'LessonController@edit')->name('lessons.edit');
    $router->patch('/courses/{course}/lessons/{lesson}/update', 'LessonController@update')->name('lessons.update');
    $router->delete('/courses/{course}/lessons/{lesson}/delete', 'LessonController@destroy')->name('lessons.destroy');
    $router->delete('/courses/{course}/lessons/deleteMultiple', 'LessonController@destroyMultiple')->name('lessons.destroyMultiple');
    $router->patch('/courses/{course}/lessons/acceptAll', 'LessonController@acceptAll')->name('lessons.acceptAll');
    $router->patch('/courses/{course}/lessons/acceptMultiple', 'LessonController@acceptMultiple')->name('lessons.acceptMultiple');
    $router->patch('/courses/{course}/lessons/rejectMultiple', 'LessonController@rejectMultiple')->name('lessons.rejectMultiple');
    $router->patch('/lessons/{lesson}/accept', 'LessonController@accept')->name('lessons.accept');
    $router->patch('/lessons/{lesson}/reject', 'LessonController@reject')->name('lessons.reject');
    $router->patch('/lessons/{lesson}/lock', 'LessonController@lock')->name('lessons.lock');
    $router->patch('/lessons/{lesson}/unlock', 'LessonController@unlock')->name('lessons.unlock');
});
