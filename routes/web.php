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

use App\Data\MpesaCallback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('/');

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();

Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('list-zones', 'HomeController@index')->name('list-zones');

Route::resource('attendance', 'AttendanceController');
Route::get('attendance-list', 'AttendanceController@allData')->name('attendance-list');

Route::get('admit-member/{id}/', 'AttendanceController@admitUser')->name('admit-member');
Route::get('cancel-member/{id}/', 'AttendanceController@CancelUser')->name('cancel-member');
Route::get('members/template', 'MembersController@template')->name('members.template');
Route::resource('members', 'MembersController');
Route::get('list-members', 'MembersController@allMembers')->name('list-members');


Route::resource('messaging', 'MessagingController');
Route::get('list-messages', 'MessagingController@allmessages')->name('list-messages');
Route::get('prepare-users', 'MessagingController@prepareUsers')->name('prepare-users');

Route::resource('groups', 'Settings\GroupsController');
Route::get('list-groups', 'Settings\GroupsController@anyData')->name('list-groups');

Route::get('get-groups/{id}', 'MembersController@memberGroups')->name('get-groups');
Route::get('save-groups/{modulesdata}/{userid}', 'MembersController@saveGroups')->name('save-groups');

Route::resource('schedules', 'Settings\SchedulesController');
Route::get('list-schedules', 'Settings\SchedulesController@anyData')->name('list-schedules');

Route::resource('events', 'Settings\EventController');
Route::get('list-events', 'Settings\EventController@anyData')->name('list-events');

Route::resource('zones', 'Settings\ZonesController');
Route::get('list-zones', 'Settings\ZonesController@anyData')->name('list-zones');
Route::get('outbox', 'MessagingController@outbox')->name('outbox');
Route::get('pending', 'MessagingController@pending')->name('pending');
Route::get('compose', 'MessagingController@newMessage')->name('compose');
Route::post('schedule-messages', 'MessagingController@scheduleMessages')->name('schedule');
Route::get('delete-message/{id}', 'MessagingController@removeScheduledMessage');
Route::get('graph', 'MessagingController@messagesByDay');
Route::get('recharge', 'MessagingController@rechargeSms')->name('recharge-sms');
Route::post('recharge-sms', 'MessagingController@recharge')->name('recharge');
Route::post('members/bulk-upload', 'MembersController@import')->name('members.bulk-upload');

Route::post('payment-status', 'PaymentController@paymentStatus')->name('payment-status');

Route::resource('projectstages', 'Settings\ProjectstagesController');
Route::get('list-projectstages', 'Settings\ProjectstagesController@anyData')->name('list-projectstages');

Route::resource('projects' ,'ProjectsController');
Route::get('list-projects','ProjectsController@anyData')->name('list-projects');

Route::resource('contributions' ,'ContributionsController');
Route::get('list-contributions','ContributionsController@anyData')->name('list-contributions');

Route::resource('incometypes','Settings\IncomeTypesController');
Route::get('list-incometypes','Settings\IncomeTypesController@anyData')->name('list-incometypes');

Route::resource('expensetypes','Settings\ExpenseTypesController');
Route::get('list-expensetypes','Settings\ExpenseTypesController@anyData')->name('list-expensetypes');

Route::resource('incomes' ,'IncomesController');
Route::get('list-incomes' ,'IncomesController@allIncomes')->name('list-incomes');

Route::resource('expenses' ,'ExpensesController');
Route::get('list-expenses' ,'ExpensesController@allExpenses')->name('list-expenses');


Route::post('payment-response', function (Request $request) {

    $data = $request->all();

    $request_id = $data['Body']['stkCallback']['CheckoutRequestID'];

    $response = [
        'checkout_request_id' => $request_id,
        'checkout_request_body' => json_encode($data)
    ];

    MpesaCallback::create($response);

});

Route::get('sms-units-recharge-history', 'MessagingController@rechargeHistory')->name('recharge-history');