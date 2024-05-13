<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;

//Welcome page
// Route::get('/', function () {
//     return redirect('/home');
// });

Route::get('/', [PostsController::class,"index"]);

//Posts page
Route::get('/home', function () {
    return redirect('/');
});

//Show create post form
Route::get('/posts/create', [PostsController::class,"create"]);

//Store new post
Route::post('/posts', [PostsController::class,"store"]);

//Show edit post form
Route::get('/posts/{id}/edit', [PostsController::class,"edit"]);

//Update edited post
Route::put('/posts/{id}', [PostsController::class,"update"]);

//Update edited post AJAX
Route::put('/posts/{id}/ajax', [PostsController::class,"updateAjax"]);

//Delete post
Route::delete('/posts/{id}', [PostsController::class,"destroy"]);

//Delete post AJAX
Route::delete('/posts/{id}/ajax', [PostsController::class,"destroyAjax"]);

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

//Show user settings
Route::get('/users/{id}/settings', [UsersController::class,"settings"]);

//Show change credentials form
Route::get('/users/{id}/settings/credentials', [UsersController::class,"credentials"]);

//Update user credentials
Route::put('/users/{id}', [UsersController::class,"update"]);

//Show change email form
Route::get('/users/{id}/settings/email', [UsersController::class,"email"]);

//Update user email
Route::put('/users/{id}/email', [UsersController::class,"updateEmail"]);

//Show change password form
Route::get('/users/{id}/settings/password', [UsersController::class,"password"]);

//Update user password
Route::put('/users/{id}/password', [UsersController::class,"updatePassword"]);

//Show change profile image form
Route::get('/users/{id}/settings/profile-image', [UsersController::class,"profileImage"]);

//Update user profile image
Route::put('/users/{id}/profile-image', [UsersController::class,"updateProfileImage"]);

//Show delete user form
Route::get('/users/{id}/settings/delete', [UsersController::class,"delete"]);

//Delete user
Route::delete('/users/{id}', [UsersController::class,"destroy"]);

//Logout user
Route::post('/logout', [UsersController::class,"logout"]);


