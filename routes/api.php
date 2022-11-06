<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('records/{record}/paid', [RecordController::class, 'updatePaymentInfo']);
    Route::apiResource('records', RecordController::class);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('logout/all', [AuthController::class, 'logoutFromAllSessions']);
});
