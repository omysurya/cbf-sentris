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

/**
 * Group Route For API Custom
 *
 * @return void
 */

Route::group(['middleware'=>['web'],'prefix'=>config('app.apiPath')], function () {
    Route::get('generate-session/{id}','ApiController@getGenerateSession');
    Route::get('documentation','ApiController@getDocumentation');
    Route::get('my-month-statistic','ApiController@getMyMonthStatistic');
    Route::get('push','ApiController@getPush');
    Route::get('default','ApiController@getDefault');
    Route::post('forgot','ApiController@postForgot');
    Route::post('logout','ApiController@postLogout');
    Route::post('login-by-sa','ApiController@postLoginBySa');
    Route::post('login','ApiController@postLogin');

});

/**
 * Group Route For API
 *
 * @return void
 */
Route::group(['middleware'=>['web','App\Http\Middleware\APICustom'],'prefix'=>config('app.apiPath')], function () {

    routeController('karyawan','ApiKaryawanController');
    routeController('berita','ApiBeritaController');
    routeController('user','ApiUserController');
});

/**
 * Group Route For Backend
 *
 * @return void
 */
Route::group(['middleware'=>['web','App\Http\Middleware\Backend'],'prefix'=>config('app.adminPath')], function () {
    routeController('menu','AdminMenuController');
    Route::get('dashboard/info/detail/{id}','AdminDashboardController@getInfoDetail');
    routeController('dashboard','AdminDashboardController');
    routeController('berita','AdminBeritaController');
    routeController('kategori-berita','AdminBeritaKategoriController');
    routeController('role','AdminRoleController');
    routeController('setting','AdminSettingController');
    routeController('kalendar-libur','AdminKalendarLiburController');
    routeController('karyawan','AdminKaryawanController');
    routeController('reguler-kota','AdminKotaRegulerController');
    routeController('provinsi','AdminProvinsiController');
    routeController('user','AdminUserController');
});

/**
 * Group Route For Frontend
 *
 * @return void
 */

Route::group(['middleware'=>['web']], function () {
    routeController(config('app.adminPath'),'AdminController');
});

//Redirect to index page (landing pages)
Route::get('/', 'AdminController@getIndex');

