<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//--------------------------------------------------------------------------------------------
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
//Route::post('/test', 'App\Http\Controllers\AuthController@test');
//--------------------------------------------------------------------------------------------

//Route::middleware('auth:sanctum')->post('/test', 'App\Http\Controllers\AuthController@test');

Route::middleware('auth:sanctum')->group( function (){
    Route::post('/test', 'App\Http\Controllers\AuthController@test');
    Route::get('/test', 'App\Http\Controllers\AuthController@test');
    Route::post('/test2', 'App\Http\Controllers\AuthController@test2');

    Route::resource('/postes', 'App\Http\Controllers\PostController');
    //Route::post('/addpost', 'App\Http\Controllers\PostController@store');
    Route::get('/postes/user/{id}', 'App\Http\Controllers\PostController@userPosts');

});




