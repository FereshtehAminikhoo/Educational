<?php

Route::group(['namespace' => 'Course\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function($router){
    $router->get('/courses/{course}/lessons/create', 'LessonController@create')->name('lessons.create');

});