<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::group(['prefix' => '/'], function(){
    Route::post('login', 'Auth\AuthController@login');
    Route::get('login', 'Auth\AuthController@loginForm')->name('login');
    Route::post('logout', 'Auth\AuthController@logout')->name('logout');

    Route::get('register', 'Auth\AuthController@registrationForm')->name('register');
    Route::post('register', 'Auth\AuthController@createUser');
    
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');

    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::get('/', function () {
    if(Auth::user()->is_admin == 0){
        return redirect()->route('admin.ticketsList.index');
    }else if(Auth::user()->is_admin == 1){
        return redirect()->route('user.ticketsList.index');
    }
})->middleware(['auth']);

//user
Route::group(['prefix' => '', 'middleware' => 'regularUser'], function () {
    Route::get('tickets-list', 'TicketListController@ticketsListUserIndex')->name('user.ticketsList.index');
    Route::post('ticket-data-store', 'TicketListController@ticketDataUserStore')->name('user.ticketData.store');
    Route::get('ticket-get-edit-data/{ticketId}', 'TicketListController@ticketUserGetEditData')->name('user.ticketData.getEdit');
    Route::post('update-ticket-data/{ticketId}', 'TicketListController@updateTicketDataUser')->name('user.ticketData.update');
    Route::delete('delete-ticket-data/{ticketId}', 'TicketListController@destroyTicketDataUser')->name('user.ticketData.destroy');

    Route::get('ticket-data/{id}', 'TicketDataController@dataTicketUserIndex')->name('user.ticketData.index');
    Route::post('get-ticket-data/{ticketId}', 'TicketDataController@getDataTicketUser')->name('user.ticketData.getTicketData');
});

//admin
Route::group(['prefix' => 'admin/', 'middleware' => 'isAdmin'], function () {
    Route::get('home', 'HomeController@adminHome')->name('admin.home');
    Route::get('processing-data', 'ProcessingDataController@index')->name('admin.processingData.index');
    Route::post('processing-data/processing-data-csv', 'ProcessingDataController@storeDataCSV')->name('admin.processingData.storeDataCSV');

    Route::post('recalculate-rula-data/{ticketId}', 'ProcessingDataController@recalculateRulaData')->name('admin.processingData.recalculateRulaData');

    Route::get('tickets-list', 'TicketListController@ticketsListAdminIndex')->name('admin.ticketsList.index');
    Route::get('ticket-get-edit-data/{ticketId}', 'TicketListController@ticketAdminGetEditData')->name('admin.ticketData.getEdit');
    Route::post('update-ticket-data/{ticketId}', 'TicketListController@updateTicketDataAdmin')->name('admin.ticketData.update');
    Route::delete('delete-ticket-data/{ticketId}', 'TicketListController@destroyTicketDataAdmin')->name('admin.ticketData.destroy');
    
    Route::get('ticket-data/{id}', 'TicketDataController@dataTicketAdminIndex')->name('admin.ticketData.index');
    Route::post('get-ticket-data/{ticketId}', 'TicketDataController@getDataTicketAdmin')->name('admin.ticketData.getTicketData');
    Route::post('approve-ticket-data/{ticketId}', 'TicketDataController@approveDataTicketAdmin')->name('admin.ticketData.approveTicketData');
    Route::post('update-ergonomic-data/{timeId}', 'TicketDataController@updateErgonomicDataAdmin')->name('admin.ticketData.updateErgonomicData');
    Route::delete('delete-ergonomics-data/{timeId}', 'TicketDataController@destroyErgonomicDataAdmin')->name('admin.ticketData.destroyErgonomicData');

    Route::post('get-ssp-rula-data/{ticketId}', 'TicketDataController@getDataSspRulaAdmin')->name('admin.sspRulaData.getDataSspRula');
    Route::get('get-ssp-rula-data-chart/{ticketId}', 'TicketDataController@getDataSspRulaChartAdmin')->name('admin.sspRulaData.getDataSspRulaChart');
});