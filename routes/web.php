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

Route::get('/','PublicController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/upload','UploadController@index')->name('upload');
Route::post('/upload','UploadController@upload')->name('upload.file');

Route::get('device/tree','DeviceController@index')->name('device.tree');
Route::get('devices/sync','DeviceController@sync')->name('device.sync');

Route::get('device/{device}/logs','DeviceController@logs');

Route::post('api/wechat/login','WechatController@login');
Route::get('api/wechat/login','WechatController@get_login');

Route::name('workers.')->group(function(){
    Route::get('workers','WorkerController@index')->name('index');
    Route::get('workers/create','WorkerController@create')->name('create');
    Route::post('workers/store','WorkerController@store')->name('store');
});



Route::namespace('API')->group(function () {

	Route::post('/api/ds/logs/fetch','DeviceLogController@fetch');

});