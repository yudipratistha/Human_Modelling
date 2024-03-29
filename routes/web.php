<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    }else if(Auth::user()->is_admin == 2){
        return redirect()->route('nioshCalculationSingleTask.index');
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

    Route::post('get-ssp-rula-data/{ticketId}', 'TicketDataController@getDataSspRulaAdmin')->name('user.sspRulaData.getDataSspRula');
    Route::get('get-ssp-rula-data-chart/{ticketId}', 'TicketDataController@getDataSspRulaChartAdmin')->name('user.sspRulaData.getDataSspRulaChart');
    Route::get('get-action-level-chart/{ticketId}', 'TicketDataController@getDataActionLevelChartAdmin')->name('user.sspRulaData.getDataActionLevelChart');

    Route::post('get-ssp-rula-data-frequency/{ticketId}', 'TicketDataController@getDataSspRulaFrequencyAdmin')->name('user.sspRulaData.getDataSspRulaFrequency');

    Route::post('get-ssp-reba-data/{ticketId}', 'TicketDataController@getDataSspRebaAdmin')->name('user.sspRebaData.getDataSspReba');
    Route::get('get-ssp-reba-data-chart/{ticketId}', 'TicketDataController@getDataSspRebaChartAdmin')->name('user.sspRebaData.getDataSspRebaChart');
    Route::get('get-action-level-chart/{ticketId}', 'TicketDataController@getDataActionLevelRebaChartAdmin')->name('user.sspRebaData.getDataActionLevelChart');

    Route::post('get-ssp-reba-data-frequency/{ticketId}', 'TicketDataController@getDataSspRebaFrequencyAdmin')->name('user.sspRebaData.getDataSspRebaFrequency');
});

//admin
Route::group(['prefix' => 'admin/', 'middleware' => 'isAdmin'], function () {
    Route::get('home', 'HomeController@adminHome')->name('admin.home');
    Route::get('processing-data', 'ProcessingDataController@index')->name('admin.processingData.index');
    Route::post('processing-data/processing-data-csv', 'ProcessingDataController@storeDataCSV')->name('admin.processingData.storeDataCSV');
    Route::post('processing-data/update-data-csv/{ticketId}', 'ProcessingDataController@updateDataCSV')->name('admin.processingData.updateDataCSV');
    Route::post('upload-simulation-video', 'ProcessingDataController@uploadLargeFiles')->name('admin.processingData.uploadLargeFiles');

    Route::post('recalculate-rula-data/{ticketId}', 'ProcessingDataController@recalculateRulaData')->name('admin.processingData.recalculateRulaData');
    Route::post('recalculate-reba-data/{ticketId}', 'ProcessingDataController@recalculateRebaData')->name('admin.processingData.recalculateRebaData');

    Route::get('tickets-list', 'TicketListController@ticketsListAdminIndex')->name('admin.ticketsList.index');
    Route::get('ticket-get-edit-data/{ticketId}', 'TicketListController@ticketAdminGetEditData')->name('admin.ticketData.getEdit');
    Route::post('update-ticket-data/{ticketId}', 'TicketListController@updateTicketDataAdmin')->name('admin.ticketData.update');
    Route::delete('delete-ticket-data/{ticketId}', 'TicketListController@destroyTicketDataAdmin')->name('admin.ticketData.destroy');

    Route::get('ticket-data/{id}', 'TicketDataController@dataTicketAdminIndex')->name('admin.ticketData.index');
    Route::post('get-ticket-data/{ticketId}', 'TicketDataController@getDataTicketAdmin')->name('admin.ticketData.getTicketData');
    Route::post('approve-ticket-data/{ticketId}', 'TicketDataController@approveDataTicketAdmin')->name('admin.ticketData.approveTicketData');

    Route::post('update-ssp-rula-data/{timeId}', 'TicketDataController@updateSspRulaDataAdmin')->name('admin.ticketData.updateSspRulaDataAdmin');
    Route::delete('delete-ssp-rula-data/{timeId}', 'TicketDataController@destroySspRulaDataAdmin')->name('admin.ticketData.destroySspRulaDataAdmin');
    Route::post('get-ssp-rula-data/{ticketId}', 'TicketDataController@getDataSspRulaAdmin')->name('admin.sspRulaData.getDataSspRula');
    Route::get('get-ssp-rula-data-chart/{ticketId}', 'TicketDataController@getDataSspRulaChartAdmin')->name('admin.sspRulaData.getDataSspRulaChart');
    Route::get('get-action-level-rula-chart/{ticketId}', 'TicketDataController@getDataActionLevelChartAdmin')->name('admin.sspRulaData.getDataActionLevelChart');

    Route::post('get-ssp-rula-data-frequency/{ticketId}', 'TicketDataController@getDataSspRulaFrequencyAdmin')->name('admin.sspRulaData.getDataSspRulaFrequency');

    Route::post('update-ssp-reba-data/{timeId}', 'TicketDataController@updateSspRebaDataAdmin')->name('admin.ticketData.updateSspRebaDataAdmin');
    Route::delete('delete-ssp-reba-data/{timeId}', 'TicketDataController@destroySspRebaDataAdmin')->name('admin.ticketData.destroySspRebaDataAdmin');
    Route::post('get-ssp-reba-data/{ticketId}', 'TicketDataController@getDataSspRebaAdmin')->name('admin.sspRebaData.getDataSspReba');
    Route::get('get-ssp-reba-data-chart/{ticketId}', 'TicketDataController@getDataSspRebaChartAdmin')->name('admin.sspRebaData.getDataSspRebaChart');
    Route::get('get-action-level-reba-chart/{ticketId}', 'TicketDataController@getDataActionLevelRebaChartAdmin')->name('admin.sspRebaData.getDataActionLevelRebaChartAdmin');

    Route::post('get-ssp-reba-data-frequency/{ticketId}', 'TicketDataController@getDataSspRebaFrequencyAdmin')->name('admin.sspRebaData.getDataSspRebaFrequencyAdmin');
});

Route::group(['prefix' => 'niosh/', 'middleware' => 'nioshUser'], function () {
    Route::get('niosh-calculation-single-task', 'NioshController@nioshCalculationSingleTask')->name('nioshCalculationSingleTask.index');
    Route::get('niosh-calculation-multi-task', 'NioshController@nioshCalculationMultiTask')->name('nioshCalculationMultiTask.index');
});
