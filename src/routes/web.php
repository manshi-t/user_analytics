<?php

use Illuminate\Support\Facades\Route;
use Mansi\Analytics\Controllers\AnalyticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/analysis',[AnalyticsController::class,'getClientInfo']);
Route::post('/analytics/{clientInfomation}',[AnalyticsController::class,'insertClientInformation'])->name('analytics');