<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/zones/import/chunk', [App\Http\Controllers\ZonesImportController::class, 'chunk'])->name('zones.import.chunk');
Route::get('/zones/import/batch', [App\Http\Controllers\ZonesImportController::class, 'getBusBatch'])->name('zones.import.batch');
Route::get('/zones/import/store', [App\Http\Controllers\ZonesImportController::class, 'store'])->name('zones.import.store');



