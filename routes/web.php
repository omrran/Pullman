<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return redirect('/home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/whatpullman', function () {
    return view('whatpullman');
});

Route::get('/login-admin', function () {
    return view('loginAdmin');
})->middleware('alreadyLoggedIn');

Route::get('/login-company', function () {
    return view('loginCompany');
})->middleware('alreadyLoggedIn');

Route::get('/login-passenger', function () {
    return view('passenger/loginPassenger');
})->middleware('alreadyLoggedIn');


Route::get('/joinUs-company', function () {
    return view('joinusCompany');
})->middleware('alreadyLoggedIn');
Route::get('/joinUs-passenger', function () {
    return view('passenger/joinusPassenger'); // passenger.joinusPassenger  also work
})->middleware('alreadyLoggedIn');


Route::get('/companies', [MainController::class, 'getCompanies']);

Route::post('/join-company', [MainController::class, 'joinCompany']);
Route::post('/join-passenger', [MainController::class, 'joinPassenger']);

Route::post('/company-page', [MainController::class, 'checkCompanyLogin']);
Route::post('/passenger-page', [MainController::class, 'checkPassengerLogin']);
Route::post('/admin-page', [MainController::class, 'checkAdminLogin']);


Route::group(['prefix' => 'admin-profile', 'middleware' => 'checkAuthAdmin'], function () {
    Route::get('/', [MainController::class, 'adminProfile']);
    Route::get('/companies', [MainController::class, 'adminProfile_companies']);
    Route::get('/passengers', [MainController::class, 'adminProfile_passengers']);
    Route::get('/companies-requests', [MainController::class, 'adminProfile_companies_requests']);
    Route::get('/logs', [MainController::class, 'adminProfile_logs']);
    Route::get('/block-company/{id}', [MainController::class, 'adminProfile_blockComp']);
    Route::get('/unblock-company/{id}', [MainController::class, 'adminProfile_unBlockComp']);
    Route::get('/log-out-adm', [MainController::class, 'logOutAdm']);


    //this routes used in AJAX calls in Public/js/code.js file ;
    Route::get('/activate-company/{id}', [MainController::class, 'activateCompany']);
    Route::get('/block-passenger/{id}', [MainController::class, 'adminProfile_blockPassenger']);
    Route::get('/unBlock-passenger/{id}', [MainController::class, 'adminProfile_unBlockPassenger']);
});

Route::group(['prefix' => 'company-profile', 'middleware' => 'checkAuthCompany'], function () {
    Route::get('/', [MainController::class, 'companyProfile']);
    Route::get('/trip-form', [MainController::class, 'getTripForm']);
    Route::post('/add-trip', [MainController::class, 'addTrip']);
    Route::get('/old-trips', [MainController::class, 'oldTrips']);
    Route::post('/old-trips-filter/', [MainController::class, 'oldFilteredTrips']);
    Route::get('/write-post', [MainController::class, 'writePost']);
    Route::post('/save-post', [MainController::class, 'savePost']);
    Route::get('/news', [MainController::class, 'news']);
    Route::post('/edit-trip', [MainController::class, 'editTrip']);
    Route::get('/log-out-comp', [MainController::class, 'logOutComp']);


});

Route::group(['prefix' => 'passenger-profile', 'middleware' => 'checkAuthPassenger'], function () {
    Route::get('/', [MainController::class, 'passengerProfile']);
    Route::get('/write-post', [MainController::class, 'writePostPassenger']);
    Route::post('/save-post', [MainController::class, 'savePost']);
    Route::get('/log-out-pass', [MainController::class, 'logOutPass']);

});


Route::get('clear-session', function () {
    Session::forget('LoggedAdmin');
    Session::forget('LoggedCompany');
    Session::forget('LoggedPassenger');
});

Route::get('all-session', function () {
    return Session::all();
});



