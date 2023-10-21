<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ManagerController;

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin'])->name('login');
Route::get('/register', [UserController::class, 'getRegister']);
Route::post('/register', [UserController::class, 'postRegister'])->name('register');
Route::get('/logout', [UserController::class, 'getLogout']);
Route::get('/infor', [UserController::class, 'infor'])->name('infor');
Route::post('/infor', [UserController::class, 'infor_post'])->name('update_infor');
Route::get('/change-password', [UserController::class, 'get_newpass']);
Route::post('/change-password', [UserController::class, 'change_pass'])->name('change_pass');


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function(){
    Route::get('/home', [BackController::class, 'home']);
    Route::group(['prefix' => '/manager'], function(){
        Route::get('/user', [ManagerController::class, 'user']);
        Route::delete('/user', [ManagerController::class, 'delete_user'])->name('deleteUser');
        Route::get('/news', [ManagerController::class, 'news']);
        Route::get('/categories', [ManagerController::class, 'categories']);
        Route::get('/add-categories', [ManagerController::class, 'add_categories']);
        Route::post('/add-categories', [ManagerController::class, 'post_categories'])->name('post_categories');
        Route::get('/update-category/{id}', [ManagerController::class, 'get_update_cat']);
        Route::post('/update-category', [ManagerController::class, 'update_cat'])->name('update_cat');
        Route::delete('/categories', [ManagerController::class, 'delete_category'])->name('deletecategory');
    });
});

Route::group(['prefix' => '/user', 'middleware' => 'auth'], function(){
    Route::get('/home', [BackController::class, 'home']);
    Route::group(['prefix' => '/manager'], function(){
        Route::get('/news', [ManagerController::class, 'news']);
    });
});