<?php

use Illuminate\Http\Request;

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

Route::get('/me', 'Api\UserController@show')->name('me');

Route::get('/week/{week}/overview', 'Api\ContentsController@weeklyOverview');

Route::get('/week/{week}/training-split', 'Api\ContentsController@weeklyTrainingSplit');

Route::get('/week/{week}/workouts/{day}', 'Api\ContentsController@weeklyWorkouts');

Route::get('/week/{week}/recipes', 'Api\ContentsController@weeklyRecipes');

Route::get('/week/{week}/meal-plan', 'Api\ContentsController@weeklyMealPlan');

Route::get('/education/{type}', 'Api\ContentsController@education');
Route::get('/exercise-demos', 'Api\ContentsController@exerciseDemos');
Route::get('/elite', 'Api\ContentsController@elite');

Route::post('/user', 'Api\UserController@update');
Route::post('/user/upload-photo', 'Api\UserController@uploadPhoto');

Route::get('/user/progresses', 'Api\ProgressesController@index');
Route::post('/user/progresses/{week}/upload-photo', 'Api\ProgressesController@uploadPhoto');
Route::post('/user/renew-subscription', 'Api\UserController@renewSubscription');
Route::post('/user/cancel-subscription', 'Api\UserController@cancelSubscription');
Route::post('/user/validate-card', 'Api\UserController@validateCard');
Route::post('/user/register', 'Api\UserController@store');
Route::post('/user/pre-register', 'Api\UserController@preRegister');

Route::post('/send-password-reset-link', 'Api\UserController@sendResetLinkEmail');