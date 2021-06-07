npm<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/reg', function () {
    return view('auth.register');
})->name('reg');
Route::group(['middleware' => 'auth'], function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/vercpe', 'App\Http\Controllers\VerController@index')->name('vercpe');
Route::get('/buscpe', 'App\Http\Controllers\VerController@buscar')->name('buscpe');
Route::post('/archivo', 'App\Http\Controllers\ArchivosController@index')->name('archivo');
Route::post('/actu', 'App\Http\Controllers\ArchivosController@actu')->name('actu');
Route::post('/borraractu', 'App\Http\Controllers\ArchivosController@borraractu')->name('borraractu');
Route::post('/rescpe', 'App\Http\Controllers\VerController@rescpe')->name('rescpe');
Route::post('/verpar', 'App\Http\Controllers\ParametrosController@verpar')->name('verpar');
Route::post('/modpar', 'App\Http\Controllers\ParametrosController@modpar')->name('modpar');
Route::post('/rein', 'App\Http\Controllers\ReinicioController@reinicio')->name('reinicio');
Route::post('/refa', 'App\Http\Controllers\ReinicioController@factoryreset')->name('factoryreset');
Route::post('/ping', 'App\Http\Controllers\ReinicioController@ping')->name('ping');
Route::post('/pings', 'App\Http\Controllers\ReinicioController@pings')->name('pings');
Route::post('/pingb', 'App\Http\Controllers\ReinicioController@pingb')->name('pingb');

Route::resource('parametros', 'App\Http\Controllers\ParametrosController');
Route::resource('regcpe', 'App\Http\Controllers\CpeController');
Route::resource('regla', 'App\Http\Controllers\ReglaController');

Route::get('/listed', 'App\Http\Controllers\CpeController@listed')->name('listed');
Route::get('/listdes', 'App\Http\Controllers\CpeController@listdes')->name('listdes');

Route::get('/cregla', 'App\Http\Controllers\ReglaController@cregla')->name('cregla');
Route::get('/aregla', 'App\Http\Controllers\ReglaController@aregla')->name('aregla');
Route::get('/regla/{earegla}/earegla', 'App\Http\Controllers\ReglaController@earegla')->name('earegla');
Route::delete('/regla/{daregla}/daregla', 'App\Http\Controllers\ReglaController@daregla')->name('daregla');
Route::post('/maregla', 'App\Http\Controllers\ReglaController@maregla')->name('maregla');
Route::post('/store2', 'App\Http\Controllers\ReglaController@store2')->name('store2');

Route::get('/charts', 'App\Http\Controllers\ChartController@index')->name('charts');
    Route::get('/chnodos', 'App\Http\Controllers\ChartController@nodos')->name('chnodos');



});

Route::resource('admin/users', 'App\Http\Controllers\AdminUsersController');
