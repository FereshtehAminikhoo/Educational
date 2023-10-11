<?php
//authentication user
Route::group([
    'namespace'=>'User\Http\Controllers',
    'middleware'=>'web'
], function ($router) {
    Auth::routes(['verify'=>true]);
});
