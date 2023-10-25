<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/*Route::get('/verify-link/{user}/', function(){
    if (request()->hasValidSignature()){
        return 'ok';
    }
    return 'Failed';
})->name('verify-link');

Route::get('/test', function(){
    $url = URL::temporarySignedRoute('verify-link', now()->addSeconds(20), ['user' => 5]);
    dd($url);
});*/

Route::get('/test', function () {
    return new \User\Mail\VerifyCodeMail(\User\Models\User::first(),32454);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
