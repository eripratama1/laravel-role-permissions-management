<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * Mendefinisikan route::group dengan middlewarenya auth
 * Jadi untuk mengakses halaman home user harus melakukan 
 * login terlebih dahulu.
 */
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
    /**
     * Dan untuk route ini dengan middlewarenya yaitu role
     * Hanya role yang sudah didefinisikan pada route group tersebut yang bisa
     * mengakses routes yang ada
     * 
     * Jika user tidak memiliki role Sama sekali maka user tersebut 
     * hanya akan melihat tampilan halaman home saja tanpa bisa mengakses
     * halaman/route yang lainnya.
     */
    Route::group(['middleware' => ['role:Admin|SuperAdmin|User']], function () {
        Route::get('/list-user', [App\Http\Controllers\HomeController::class, 'listUser'])->name('list-user');

        Route::get('/assign-role/{id}', [\App\Http\Controllers\HomeController::class, 'assignRole'])->name('assign-role');
        Route::put('/set-role/{id}', [\App\Http\Controllers\HomeController::class, 'setRole'])->name('set-role');

        Route::get('/list-permission', [\App\Http\Controllers\HomeController::class, 'listPermission'])->name('list-permission');
        Route::get('/create-permission', [\App\Http\Controllers\HomeController::class, 'createPermission'])->name('create-permission');
        Route::post('/store-permission',[\App\Http\Controllers\HomeController::class,'storePermission'])->name('store-permission');
        Route::get('/edit-permission/{id}', [\App\Http\Controllers\HomeController::class, 'editPermission'])->name('edit-permission');

        Route::get('/assign-permission/{id}',[\App\Http\Controllers\HomeController::class,'assignPermission'])->name('assign-permission');
        Route::put('/set-permission/{id}',[\App\Http\Controllers\HomeController::class,'setPermission'])->name('set-permission');
    });
});
