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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/zones/results', [App\Http\Controllers\ZonesImportController::class, 'results'])->middleware('auth')->name('zones.import.results');
Route::get('/zones', [App\Http\Controllers\ZonesController::class, 'index'])->middleware('auth')->name('zones');
Route::get('/errors', [App\Http\Controllers\ZonesImportController::class, 'errors'])->middleware('auth')->name('zones.import.errors');
Route::get('/zones/errors', [App\Http\Controllers\ErrorsImportZonesController::class, 'index'])->middleware('auth')->name('errors');

