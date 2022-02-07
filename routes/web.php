<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PassengerController;
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
    return view('admin.loginAdmin');
})->middleware('alreadyLoggedIn');

Route::get('/login-company', function () {
    return view('company.loginCompany');
})->middleware('alreadyLoggedIn');

Route::get('/login-passenger', function () {
    return view('passenger/loginPassenger');
})->middleware('alreadyLoggedIn');


Route::get('/joinUs-company', function () {
    return view('company.joinusCompany');
})->middleware('alreadyLoggedIn');

Route::get('/joinUs-passenger', function () {
    return view('passenger/joinusPassenger'); // passenger.joinusPassenger  also work
})->middleware('alreadyLoggedIn');


Route::get('/companies', [AdminController::class, 'getCompanies']);

Route::post('/join-company', [CompanyController::class, 'joinCompany']);
Route::post('/join-passenger', [PassengerController::class, 'joinPassenger']);

Route::post('/company-page', [CompanyController::class, 'checkCompanyLogin']);
Route::post('/passenger-page', [PassengerController::class, 'checkPassengerLogin']);
Route::post('/admin-page', [AdminController::class, 'checkAdminLogin']);


Route::group(['prefix' => 'admin-profile', 'middleware' => 'checkAuthAdmin'], function () {
    Route::get('/', [AdminController::class, 'adminProfile']);
    Route::get('/companies', [AdminController::class, 'adminProfile_companies']);
    Route::get('/passengers', [AdminController::class, 'adminProfile_passengers']);
    Route::get('/companies-requests', [AdminController::class, 'adminProfile_companies_requests']);
    Route::get('/logs', [AdminController::class, 'adminProfile_logs']);
    Route::get('/block-company/{id}', [AdminController::class, 'adminProfile_blockComp']);
    Route::get('/unblock-company/{id}', [AdminController::class, 'adminProfile_unBlockComp']);
    Route::get('/company/{id}', [AdminController::class, 'showACompany']);
    Route::get('/passenger/{id}', [AdminController::class, 'showAPassenger']);
    Route::get('/trip/{id}', [AdminController::class, 'showATrip']);
    Route::get('/company/post/{id}', [AdminController::class, 'showACompPost']);
    Route::get('/passenger/post/{id}', [AdminController::class, 'showAPassPost']);
    Route::get('/reserve/{id}', [AdminController::class, 'showAReserve']);


    Route::get('/log-out-adm', [AdminController::class, 'logOutAdm']);


    //this routes used in AJAX calls in Public/js/code.js file ;
    Route::get('/activate-company/{id}', [AdminController::class, 'activateCompany']);
    Route::get('/block-passenger/{id}', [AdminController::class, 'adminProfile_blockPassenger']);
    Route::get('/unBlock-passenger/{id}', [AdminController::class, 'adminProfile_unBlockPassenger']);
});

Route::group(['prefix' => 'company-profile', 'middleware' => 'checkAuthCompany'], function () {
    Route::get('/', [CompanyController::class, 'companyProfile']);
    Route::get('/trip-form', [CompanyController::class, 'getTripForm']);
    Route::post('/add-trip', [CompanyController::class, 'addTrip']);
    Route::get('/old-trips', [CompanyController::class, 'oldTrips']);
    Route::post('/old-trips-filter/', [CompanyController::class, 'oldFilteredTrips']);
    Route::get('/write-post', [CompanyController::class, 'writePost']);
    Route::post('/save-post', [CompanyController::class, 'savePost']);
    Route::get('/news', [CompanyController::class, 'news']);
    Route::post('/edit-trip', [CompanyController::class, 'editTrip']);
    Route::get('/view-profile', [CompanyController::class, 'viewProfile']);
    Route::get('/edit-profile', [CompanyController::class, 'editProfile']);
    Route::post('/save-new-profile-info', [CompanyController::class, 'saveNewProfileInfo']);
    Route::get('/activity-log', [CompanyController::class, 'activityLog']);
    Route::get('/trip/{id}', [CompanyController::class, 'showTrip']);
    Route::get('/post/{id}', [CompanyController::class, 'showPost']);
    Route::get('/log-out-comp', [CompanyController::class, 'logOutComp']);


});

Route::group(['prefix' => 'passenger-profile', 'middleware' => 'checkAuthPassenger'], function () {
    Route::get('/', [PassengerController::class, 'passengerProfile']);
    Route::get('/write-post', [PassengerController::class, 'writePostPassenger']);
    Route::post('/save-post', [PassengerController::class, 'savePost']);
    Route::get('/news', [PassengerController::class, 'passengerNews']);
    Route::get('/trip/{idTrip}', [PassengerController::class, 'showATrip']);
    Route::get('/view-profile', [PassengerController::class, 'viewProfile']);
    Route::get('/edit-profile', [PassengerController::class, 'editProfile']);
    Route::post('/save-new-profile-info', [PassengerController::class, 'saveNewProfileInfo']);
    Route::get('/activity-log', [PassengerController::class, 'activityLog']);
    Route::get('/reserve/{id}', [PassengerController::class, 'showReserve']);
    Route::get('/post/{id}', [PassengerController::class, 'showPost']);
    Route::get('/log-out-pass', [PassengerController::class, 'logOutPass']);

    //this routes used in AJAX calls in Public/js/code.js file ;
    Route::get('/reserve-seat/{idTrip}', [PassengerController::class, 'reserveASeat']);

});


Route::get('clear-session', function () {
    Session::forget('LoggedAdmin');
    Session::forget('LoggedCompany');
    Session::forget('LoggedPassenger');
});

Route::get('all-session', function () {
    return Session::all();
});



