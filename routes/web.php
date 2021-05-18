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

Route::resource('admin/users', 'App\Http\Controllers\AdminUsersController');
Route::resource('parametros', 'App\Http\Controllers\ParametrosController');
Route::resource('regcpe', 'App\Http\Controllers\CpeController');

Route::get('/listed', 'App\Http\Controllers\CpeController@listed')->name('listed');
Route::get('/listdes', 'App\Http\Controllers\CpeController@listdes')->name('listdes');

Route::get('/cregla', 'App\Http\Controllers\ReglaController@cregla')->name('cregla');
Route::get('/aregla', 'App\Http\Controllers\ReglaController@aregla')->name('aregla');
