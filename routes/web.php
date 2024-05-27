<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\WeatherApiController;

//Welcome page
// Route::get('/', function () {
//     return redirect('/home');
// });

Route::get('/', [PostsController::class,"index"]);

//Show posts order by Likes amount
Route::get('/trending', [PostsController::class,"indexByLikes"]);

//Show posts liked or commented by user
Route::get('/myfeed', [PostsController::class,"indexByUserInteraction"]);

//Show advanced search form
Route::get('/a-search', [PostsController::class,"createAdvancedSearch"]);

//Advanced search
Route::post('/a-search', [PostsController::class,"advancedSearch"]);

//Posts page
Route::get('/home', function () {
    return redirect('/');
});

//Get post data
Route::get('/posts/{id}/data', [PostsController::class,"getDataJson"]);

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

//Store new comment
Route::post('/posts/{id}/comment', [CommentsController::class,"store"]);

//Register page / show form
Route::get('/register', [UsersController::class,"create"]);

//Login page / show form
Route::get('/login', [UsersController::class,"login"]);

//Login user
Route::post('/users/authenticate', [UsersController::class,"authenticate"]);

//Store new user
Route::post('/users', [UsersController::class,"store"]);

//Show user
Route::get('/users/{id}', [UsersController::class,"show"]);

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

//Show update city form
Route::get('/users/{id}/settings/city', [UsersController::class,"city"]);

//Update city
Route::put('/users/{id}/city', [UsersController::class,"updateCity"]);

//Show delete user form
Route::get('/users/{id}/settings/delete', [UsersController::class,"delete"]);

//Delete user
Route::delete('/users/{id}', [UsersController::class,"destroy"]);

//Logout user
Route::post('/logout', [UsersController::class,"logout"]);

//Like post
Route::post('/posts/{id}/like', [PostsController::class, 'likePost']);

//Follow user
Route::post('/users/{id}/follow', [FollowsController::class, 'followUser']);

//Show users that user follows
Route::get('/users/{id}/following', [FollowsController::class, 'indexFollowing']);

//WeatherAPI get weather data
Route::get('/weather', [WeatherApiController::class, 'getWeatherData']);
