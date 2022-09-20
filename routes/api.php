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


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/list-schedules', 'api\SchedulesController@list_services');
    Route::post('/book-slot', 'api\SchedulesController@bookSlot');
    Route::resource('/profile', 'api\ProfileController');
});
Route::post('/resend-code', 'api\auth\LoginController@resendCode');
Route::post('/reset/password', 'api\auth\LoginController@resetPassword');
Route::post('/verify', 'api\auth\LoginController@verify');
Route::post('/login', 'api\auth\LoginController@login');
Route::post('/register', 'api\auth\RegisterController@create');
Route::post('/contact-us', 'api\ContactUsController@create');
Route::post('/create-schedule/{id}', 'api\SchedulesController@create');
Route::get('/list-zones', 'api\ZoneController@list_zones');
Route::get('/list-churches', 'api\ChurchController@list_churches');
Route::get('/list-zones/{id}', 'api\ZoneController@list_church_zones');

