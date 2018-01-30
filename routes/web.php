<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/home', 301);

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dash');
    Route::get('dashboard/weekly/meal-plan', 'DashboardController@weeklyMealPlan')->name('admin.dash.mealPlan');
    Route::get('dashboard/weekly/recipes', 'DashboardController@weeklyRecipes')->name('admin.dash.recipes');
    Route::get('dashboard/weekly/{type}', 'DashboardController@weekly')->name('admin.dash.weekly');
    Route::any('dashboard/weekly-edit/{id}', 'DashboardController@weeklyEdit')->name('admin.dash.weeklyEdit');

    Route::any('dashboard/page-edit/add/{type}', 'DashboardController@pageAdd')->name('admin.dash.pageAdd');
    Route::any('dashboard/page-edit/{id}', 'DashboardController@pageEdit')->name('admin.dash.pageEdit');
    Route::get('dashboard/education', 'DashboardController@education')->name('admin.dash.education');
    Route::get('dashboard/exercise-demo', 'DashboardController@exerciseDemo')->name('admin.dash.exerciseDemo');
    Route::get('dashboard/becoming-elite', 'DashboardController@becomingElite')->name('admin.dash.becomingElite');

    Route::get('/upload-media', 'MediaController@index')->name('admin.media');
    Route::post('upload-media', 'MediaController@store')->name('admin.media.store');

    Route::get('/users', 'UsersController@index')->name('admin.users');
    Route::get('/users/{id}', 'UsersController@edit')->name('admin.users.edit');
    Route::post('/users/{id}', 'UsersController@edit')->name('admin.users.edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/public/media/{url}', 'PublicController@media')->name('public.media');

Route::post('/click-funnels/webhook', 'PublicController@webhook');
Route::post('/funnel_webhooks/test', function() {
    // for  clickfunnels to accept our webhook endpoint
    return response()->json(['success' => true]);
});

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);