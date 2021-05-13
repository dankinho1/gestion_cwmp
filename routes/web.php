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
Route::post('/verpar', 'App\Http\Controllers\ParametrosController@verpar')->name('verpar');
Route::get('/modpar', 'App\Http\Controllers\ParametrosController@modpar')->name('modpar');

Route::resource('admin/users', 'App\Http\Controllers\AdminUsersController');
Route::resource('parametros', 'App\Http\Controllers\ParametrosController');

