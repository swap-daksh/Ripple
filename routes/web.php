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

Route::group(["as" => "Ripple::", 'namespace' => config('ripple.controllers.namespace', 'ETU\Ripple\Http\Controllers'), 'middleware' => ['web']], function() {
    /*
      |----------------------------------------------------------------------
      |	Admin Route
      |----------------------------------------------------------------------
     */
    Route::any('/admin', "RippleController@dashboard")->name('adminDashboard');

    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Settings
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::match(['get', 'post'], '/settings', "SettingsController@settings")->name('adminSettings');
    Route::post('/delete/setting', "SettingsController@deleteSetting")->name('adminDeleteSetting');


    /*
      |-------------------------------------------------------------------------------------------------------------------
      |                              Database
      |-------------------------------------------------------------------------------------------------------------------
     */
    Route::any('/database', "DatabaseController@database")->name('adminDatabase');
    Route::any('/database/create', "DatabaseController@createTable")->name('adminCreateTable');

    Route::get('/ripple', function() {
        return view('Ripple::welcome');
    });
    Route::get('/asdf/asdf/asdf/asdf/ripple', function() {
        return view('Ripple::welcome');
    })->name('asdf');
    Route::get('/test', "RippleController@index");
    Route::get('/test-ripple', "RippleController@index");
});
