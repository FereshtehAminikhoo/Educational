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

Route::get('/test', function () {
   // \Spatie\Permission\Models\Permission::create(['name' => 'teach']);
   //auth()->user()->givePermissionTo(\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN);
   return auth()->user()->assignRole('teacher');
});



