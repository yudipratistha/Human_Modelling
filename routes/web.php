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

// Route::get('/', function () {
//     return view('home');
// });
Auth::routes();
// Route::group(['prefix' => '', 'middleware' => 'is_admin'], function () {
//     Route::get('/', 'HomeController@index')->name('index');
// });


Route::group(['prefix' => '', 'middleware' => 'is_admin'], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

//admin
Route::group(['prefix' => 'admin/', 'middleware' => 'is_admin'], function () {
    Route::get('home', 'HomeController@adminHome')->name('admin.home');
    Route::get('processing-data', 'ProcessingDataController@index')->name('admin.processingData.index');
    Route::post('processing-data/processing-data-csv', 'ProcessingDataController@storeDataCSV')->name('admin.processingData.storeDataCSV');

    Route::get('tickets-list', 'TicketDataController@ticketsListIndex')->name('admin.ticketsList.index');
    Route::post('ticket-data-store', 'TicketDataController@ticketDataStore')->name('admin.ticketData.store');
    Route::get('ticket-get-edit-data/{ticketId}', 'TicketDataController@ticketGetEditData')->name('admin.ticketData.getEdit');
    Route::post('update-ticket-data/{ticketId}', 'TicketDataController@updateTicketData')->name('admin.ticketData.update');
    Route::delete('delete-ticket-data/{ticketId}', 'TicketDataController@destroyTicketData')->name('admin.ticketData.destroy');
    
    Route::get('ticket-data/{id}', 'TicketDataController@dataTicketIndex')->name('admin.ticketData.index');
    Route::post('get-ticket-data/{ticketId}', 'TicketDataController@getDataTicket')->name('admin.ticketData.getTicketData');
    Route::post('approve-ticket-data/{ticketId}', 'TicketDataController@approveDataTicket')->name('admin.ticketData.approveTicketData');
    Route::post('update-data-ergonomic/{timeId}', 'TicketDataController@updateDataErgonomic')->name('admin.ticketData.updateDataErgonomic');


    // Route::group(['prefix' => 'data/'], function () {
        
    // });
});