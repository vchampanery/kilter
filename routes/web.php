<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\visitor;
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
$unique_ip = true;
$visitors = Visitor::all();
foreach($visitors as $visitor){
    // if(($visitor->ip_address == $_SERVER['REMOTE_ADDR']) && ($visitor->visitor_date == date('Y-m-d H:00:00'))) {
    //     $unique_ip = false;
    // }
}

if($unique_ip == true){
    // $visitor = Visitor::create([
    //     'ip_address' => $_SERVER['REMOTE_ADDR'],
    //     'visitor_date' => date('Y-m-d H:00:00'),
    // ]);
}

Route::get('/', 'App\Http\Controllers\HomeController@personal_board')->name('home.personal_board');

Route::get('/strava', function () {
    return view('strava');
});
Route::get('/adminlte', function () {
    return view('adminlte');
});

//final
Route::any('/personal_board/{id?}', 'App\Http\Controllers\HomeController@personal_board')->name('home.personal_board');
Route::any('/personal_board_year/{id?}', 'App\Http\Controllers\HomeController@personal_board_year')->name('home.personal_board_year');
// Route::post('/personal_board', 'App\Http\Controllers\HomeController@personal_board')->name('home.personal_board');
Route::get('/team_board', 'App\Http\Controllers\HomeController@team_board')->name('home.team_board');
Route::get('/team_life_board', 'App\Http\Controllers\HomeController@team_life_board')->name('home.team_life_board');
Route::any('/resetpassword', 'App\Http\Controllers\CustomAuthController@resetpassword')->name('customauth.resetpassword');
// Route::get('/login1', 'App\Http\Controllers\LoginController@login1')->name('customauth.login1');
Route::post('/customresetpassword', 'App\Http\Controllers\CustomAuthController@customresetpassword')->name('customauth.customresetassword');

Route::any('/saveProfile', 'App\Http\Controllers\UserController@saveProfile')->name('user.saveProfile');
Route::any('/saveReview', 'App\Http\Controllers\UserController@saveReview')->name('user.saveReview');
// Route::post('/customresetpassword', 'App\Http\Controllers\CustomAuthController@customresetpassword')->name('customauth.customresetassword');
Route::get('/fetch_data', 'App\Http\Controllers\StravaController@fetch_data')->name('home.fetch_data');
Route::get('/strava_reset/{id}', 'App\Http\Controllers\StravaController@reset')->name('strava.reset');
Route::get('/updatedefualtpassword/{id}', 'App\Http\Controllers\StravaController@updatedefualtpassword')->name('strava.updatedefualtpassword');
Route::get('/getdatabycron/{start}/{end}/{by}', 'App\Http\Controllers\StravaController@getdatabycron')->name('home.getdatabycron');
Route::get('/searchboarddata', 'App\Http\Controllers\StravaController@searchboarddata')->name('home.searchboarddata');

Route::get('/profile/{id?}', 'App\Http\Controllers\UserController@profile')->name('user.profile');
Route::get('/review/{id?}', 'App\Http\Controllers\UserController@review')->name('user.review');

Route::any('/testwebhook', 'App\Http\Controllers\UserController@testwebhook')->name('user.testwebhook');


Route::get('/webhook/callback', 'App\Http\Controllers\UserController@verifyCallback');
Route::post('/webhook/callback', 'App\Http\Controllers\UserController@handleCallback');

Route::get('/fetch_data/{id}/{cron}', 'App\Http\Controllers\StravaController@fetch_data')->name('home.fetch_data');
Route::get('/fetch_data1/{id}/{cron}', 'App\Http\Controllers\StravaController@fetch_data1')->name('home.fetch_data1');
Route::get('/certificate-sacc2023/{id?}', 'App\Http\Controllers\HomeController@certificate')->name('home.certificate');


// Route::get('/first_page/{id?}', 'App\Http\Controllers\HomeController@first_page')->name('home.first_page');
Route::get('/activity/{id?}', 'App\Http\Controllers\HomeController@activity')->name('home.activity');
Route::get('/viewdetail/{id?}', 'App\Http\Controllers\HomeController@viewdetail')->name('home.viewdetail');
Route::get('/board', 'App\Http\Controllers\HomeController@board')->name('home.board');
Route::get('/sacc2023/{start?}/{stop?}', 'App\Http\Controllers\HomeController@sacc2023')->name('home.sacc2023');
Route::get('/goal_board', 'App\Http\Controllers\HomeController@goalboard')->name('home.goal_board');
Route::any('/addgoal', 'App\Http\Controllers\HomeController@addgoal')->name('home.addgoal');
Route::any('/add_activity_manual', 'App\Http\Controllers\HomeController@addstravaactivity')->name('home.addstravaactivity');
Route::get('/fpage', 'App\Http\Controllers\RoleController@fpage')->name('home.fpage');
Route::get('/roless', 'App\Http\Controllers\RoleController@index')->name('home.index');
Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('register.index');

Route::any('/team/create', 'App\Http\Controllers\TeamController@create')->name('team.create');

// Route::get('/second_page', 'App\Http\Controllers\HomeController@second_page')->name('home.second_page');
Route::get('/auth_page', 'App\Http\Controllers\StravaController@auth_page')->name('home.auth_page');
Route::get('/pulluserdata', 'App\Http\Controllers\StravaController@pullUserData')->name('home.pulluserdata');
Route::get('/pullactivitydata/{id?}/{year?}', 'App\Http\Controllers\StravaController@pullActivityData')->name('home.pullActivityData');
Route::get('/testjson', 'App\Http\Controllers\HomeController@testjson')->name('home.testjson');


Route::get('/strava/getauth', 'App\Http\Controllers\StravaController@getAuth')->name('strava.getAuth');
Route::get('/file-import', 'App\Http\Controllers\UserController@importView')->name('import-view');
Route::post('/import', 'App\Http\Controllers\UserController@import')->name('import');
Route::get('/review', 'App\Http\Controllers\UserController@review')->name('review');
Route::post('/submit-review', 'App\Http\Controllers\UserController@submitreview')->name('submitreview');
Route::get('/export-users', 'App\Http\Controllers\UserController@exportUsers')->name('export-users');
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


// Route::get('',[UserController::class,
// 'importView'])->name('import-view');
// Route::post('/import',[UserController::class,
// 'import'])->name('import');
// Route::get('/export-users',[UserController::class,
// 'exportUsers'])->name('export-users');
