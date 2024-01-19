<?php

//authentication user

Route::group([
    'namespace'=>'User\Http\Controllers',
    'middleware'=>'web'
], function ($router) {
    Auth::routes(['verify'=>true]);
    //verification routes
    Route::post('/email/verify', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');

    //login routes
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

    //logout route
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //reset password routes
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
    Route::get('/password/reset/send', 'Auth\ForgotPasswordController@sendVerifyCodeEmail')->name('password.sendVerifyCodeEmail');
    Route::post('/password/reset/check-verify-code', 'Auth\ForgotPasswordController@checkVerifyCode')->name('password.checkVerifyCode')
        ->middleware('throttle:5, 1');
    Route::get('/password/change', 'Auth\ResetPasswordController@showResetForm')->name('password.showResetForm')
        ->middleware('auth');
    Route::post('/password/change', 'Auth\ResetPasswordController@reset')->name('password.update');

    //register routes
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');


    //panel routes
    Route::resource('/users', 'UserController');
    Route::post('/users/{user}/add/role', 'UserController@addRole')->name('users.addRole');
    Route::delete('/users/{user}/remove/{role}/role', 'UserController@removeRole')->name('users.removeRole');



});
