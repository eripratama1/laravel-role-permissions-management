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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:Admin|SuperAdmin|User']], function () {
        Route::get('/list-user', [App\Http\Controllers\HomeController::class, 'listUser'])->name('list-user');

        Route::get('/assign-role/{id}', [\App\Http\Controllers\HomeController::class, 'assignRole'])->name('assign-role');
        Route::put('/set-role/{id}', [\App\Http\Controllers\HomeController::class, 'setRole'])->name('set-role');

        Route::get('/list-permission', [\App\Http\Controllers\HomeController::class, 'listPermission'])->name('list-permission');
        Route::get('/create-permission', [\App\Http\Controllers\HomeController::class, 'createPermission'])->name('create-permission');
        Route::post('/store-permission',[\App\Http\Controllers\HomeController::class,'storePermission'])->name('store-permission');

        Route::get('/assign-permission/{id}',[\App\Http\Controllers\HomeController::class,'assignPermission'])->name('assign-permission');
        Route::put('/set-permission/{id}',[\App\Http\Controllers\HomeController::class,'setPermission'])->name('set-permission');
    });
});
