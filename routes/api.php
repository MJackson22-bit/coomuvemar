<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralDataController;
use App\Http\Controllers\HarvestRegistrationCocoaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello World!';
});
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('general-data')->group(function () {
    Route::get('/{userId}', [GeneralDataController::class, 'index']);
    Route::post('/store/{userId}', [GeneralDataController::class, 'store']);
    Route::put('/update', [GeneralDataController::class, 'update']);
    Route::delete('/destroy', [GeneralDataController::class, 'destroy']);
});

Route::prefix('cocoa-harvest-registration')->group(function () {
    Route::get('/{generalDataId}', [HarvestRegistrationCocoaController::class, 'index']);
    Route::post('/store/{generalDataId}', [HarvestRegistrationCocoaController::class, 'store']);
    Route::put('/update/{cocoaHarvestRegistrationId}', [HarvestRegistrationCocoaController::class, 'update']);
    Route::delete('/destroy/{cocoaHarvestRegistrationId}', [HarvestRegistrationCocoaController::class, 'destroy']);
});
