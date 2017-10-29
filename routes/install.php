<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
// 安装 //'welcome','check','config','modules','installing','finished'
Route::group(['prefix' => 'install', 'namespace' => 'App\Http\Controllers','middleware' => ['web']], function() {
    
    Route::get('/', 'InstallController@welcome')->name('install.welcome');

    Route::get('check', 'InstallController@check')->name('install.check');

    Route::get('config', 'InstallController@config')->name('install.config');

    Route::get('modules', 'InstallController@modules')->name('install.modules');

    Route::get('installing', 'InstallController@installing')->name('install.installing');

    Route::get('check', 'InstallController@check')->name('install.check');

    Route::get('finished', 'InstallController@finished')->name('install.finished');
});
