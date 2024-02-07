<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Public API
Route::post('/login',  [AuthController::class,'login'])->name('user.login');;
Route::post('/user',   [UserController::class,'store'])->name('user.store');
    


//Private API
Route::middleware(['auth:sanctum', ])->group(function () {

    Route::post('/logout',  [AuthController::class,'logout'])->name('user.logout');;

    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',         'index');
        Route::get('/carousel/{id}',    'show');
        Route::delete('/carousel/{id}', 'destroy');
        Route::post('/carousel',        'store');
        Route::put('/carousel/{id}',    'update');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                 'index');
        Route::delete('/user/{id}',         'destroy'); 
        Route::get('/user/{id}',            'show');
        Route::put('/user/{id}',            'update')->name('user.update');
        Route::put('/user/email/{id}',      'email')->name('user.email');
        Route::put('/user/password/{id}',   'password')->name('user.password');
        Route::put('/user/image/{id}',      'image')->name('user.image');
    });

  
});








