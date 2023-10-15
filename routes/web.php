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

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function(){
    Route::get('/home', [BackController::class, 'home']);
    
});

//chung admin và user được
Route::get('/infor', [UserController::class, 'infor'])->name('infor');
Route::post('/infor', [UserController::class, 'infor_post'])->name('update_infor');
Route::get('/change-password', [UserController::class, 'get_newpass']);
Route::post('/change-password', [UserController::class, 'change_pass'])->name('change_pass');