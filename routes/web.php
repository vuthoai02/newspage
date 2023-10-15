<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackController;

Route::get('/admin-login', [UserController::class, 'getLogin']);
Route::post('/admin-login', [UserController::class, 'postLogin'])->name('admin-login');
Route::get('/logout', [UserController::class, 'getLogout']);



Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/home', [BackController::class, 'home']);
    Route::group(['prefix' => 'staff'], function(){
        Route::get('profile', [BackController::class, 'staff_profile']);
        Route::post('profile', [BackController::class, 'staff_profile_post']);
        Route::get('list', [BackController::class, 'staff']);
        Route::get('add', [BackController::class, 'staff_add']);
        Route::post('add', [BackController::class, 'staff_add_post']);
        Route::get('edit/{id}', [BackController::class, 'staff_edit']);
        Route::post('edit/{id}', [BackController::class, 'staff_edit_post']);
        Route::post('delete', [BackController::class, 'staff_delete']);
        Route::post('filter', [BackController::class, 'staff_filter']);
    });
});