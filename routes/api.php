<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Http\Request;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/appointment', [AppointmentsController::class, 'book']);
Route::get('/schedule', [ScheduleController::class, 'availableSlots']);
Route::get('/services', [ServicesController::class, 'index']);
Route::get('/holidays', [HolidaysController::class, 'index']);

