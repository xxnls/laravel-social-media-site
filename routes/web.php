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

//Show create post form
Route::get('/posts/create', [PostsController::class,"create"]);

//Store new post
Route::post('/posts', [PostsController::class,"store"]);

//Show edit post form
Route::get('/posts/{id}/edit', [PostsController::class,"edit"]);

//Update edited post
Route::put('/posts/{id}', [PostsController::class,"update"]);

//Delete post
Route::delete('/posts/{id}', [PostsController::class,"destroy"]);

//Show post
Route::get('/posts/{id}', [PostsController::class,"show"]);

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


