<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/strava', function () {
    return view('strava');
});
Route::get('/adminlte', function () {
    return view('adminlte');
});

//final
Route::get('/personal_board', 'App\Http\Controllers\HomeController@personal_board')->name('home.personal_board');
Route::get('/team_board', 'App\Http\Controllers\HomeController@team_board')->name('home.team_board');
Route::get('/fetch_data', 'App\Http\Controllers\StravaController@fetch_data')->name('home.fetch_data');
Route::get('/getdatabycron', 'App\Http\Controllers\StravaController@getdatabycron')->name('home.getdatabycron');
Route::get('/searchboarddata', 'App\Http\Controllers\StravaController@searchboarddata')->name('home.searchboarddata');


Route::get('/fetch_data/{id}/{cron}', 'App\Http\Controllers\StravaController@fetch_data')->name('home.fetch_data');


Route::get('/first_page', 'App\Http\Controllers\HomeController@first_page')->name('home.first_page');
Route::get('/board', 'App\Http\Controllers\HomeController@board')->name('home.board');
Route::get('/goal_board', 'App\Http\Controllers\HomeController@goalboard')->name('home.goal_board');
Route::any('/addgoal', 'App\Http\Controllers\HomeController@addgoal')->name('home.addgoal');
Route::get('/fpage', 'App\Http\Controllers\RoleController@fpage')->name('home.fpage');
Route::get('/roless', 'App\Http\Controllers\RoleController@index')->name('home.index');

// Route::get('/second_page', 'App\Http\Controllers\HomeController@second_page')->name('home.second_page');
Route::get('/auth_page', 'App\Http\Controllers\StravaController@auth_page')->name('home.auth_page');
Route::get('/pulluserdata', 'App\Http\Controllers\StravaController@pullUserData')->name('home.pulluserdata');
Route::get('/pullactivitydata', 'App\Http\Controllers\StravaController@pullActivityData')->name('home.pullActivityData');
Route::get('/testjson', 'App\Http\Controllers\HomeController@testjson')->name('home.testjson');


Route::get('/strava/getauth', 'App\Http\Controllers\StravaController@getAuth')->name('strava.getAuth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
  
// Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

Route::get('/hometest', 'App\Http\Controllers\HomeController@hometest')->name('home.hometest');