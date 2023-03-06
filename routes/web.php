<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StationController;
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

Route::get('/', [RouteController::class, 'index']);

Route::get('ticket', [BookingController::class, 'index']);
Route::get('searchticket', [BookingController::class, 'searchticket']);

Route::get('get-route/{id}', [RouteController::class, 'getRoute']);

Route::get('get-stations/{id}', [StationController::class, 'getStations']);
Route::get('get-tooltips', [StationController::class, 'getTooltips']);

Route::get('fetch-routes', [RouteController::class, 'fetchRoutes']);

Route::post('tikets', [BookingController::class, 'store']);
Route::get('get-tikets/{phone}', [BookingController::class, 'getTicket']);