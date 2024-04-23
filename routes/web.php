<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;

//Welcome page
Route::get('/', function () {
    return redirect('/home');
});

//Posts page
Route::get('/home', [PostsController::class,"index"]);

//Create post page / show form
Route::get('/posts/create', [PostsController::class,"create"]);

//Store new post
Route::post('/posts', [PostsController::class,"store"]);

//Register page / show form
Route::get('/register', [UsersController::class,"create"]);

//Login page / show form
Route::get('/login', [UsersController::class,"login"]);

//Login user
Route::post('/users/authenticate', [UsersController::class,"authenticate"]);

//Store new user
Route::post('/users', [UsersController::class,"store"]);

//Logout user
Route::post('/logout', [UsersController::class,"logout"]);


