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

Route::group(['prefix' => '', 'middleware' => 'is_admin'], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

Auth::routes();


//admin
Route::group(['prefix' => 'admin/', 'middleware' => 'is_admin'], function () {
    Route::get('home', 'HomeController@adminHome')->name('admin.home');

    Route::group(['prefix' => 'data/'], function () {
        Route::get('processing-data', 'ProcessingDataController@index')->name('admin.processingData.index');
        Route::post('processing-data/processing-data-csv', 'ProcessingDataController@storeDataCSV')->name('admin.processingData.storeDataCSV');
        Route::get('list-data-tickets', 'ViewDataController@index')->name('admin.listDataTickets.index');
        Route::get('data-ticket/{id}', 'ViewDataController@dataTicketIndex')->name('admin.dataTicket.index');
        Route::post('get-data-ticket/{tiketId}', 'ViewDataController@getDataTicket')->name('admin.dataTicket.getDataTicket');
    });
});