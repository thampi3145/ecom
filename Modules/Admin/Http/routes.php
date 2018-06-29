<?php

//Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
//{
//    Route::get('/', 'AdminController@index');
//});
//Route::get('/adminlogin','Modules\Admin\Http\Controllers\AdminController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@loginAction')->name('admin.login.submit');
    Route::get('/', 'AdminHomeController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logoutAdminAction')->name('admin.logout');
});


