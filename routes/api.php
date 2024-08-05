<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Http\Request;
use App\Models\HistoryButton;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\HistoryButtonController;
use App\Http\Controllers\ResidentialBlockController;
use App\Http\Controllers\DeviceActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmergencyReportController;
use App\Http\Controllers\EmergencyStateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/emergency-state', [EmergencyStateController::class, 'dataTable'])
        ->name('emergencyState.dataTable')
        ->middleware('auth:sanctum');

Route::get('/emergency-report', [EmergencyReportController::class, 'dataTable'])
        ->name('EmergencyReport.dataTable')
        ->middleware('auth:sanctum');
Route::post('/emergency-report', [EmergencyReportController::class, 'store'])
        ->name('EmergencyReport.store')
        ->middleware('auth:sanctum');
Route::get('/emergency-report/{id}', [EmergencyReportController::class, 'show'])
        ->name('EmergencyReport.show')
        ->middleware('auth:sanctum');
Route::put('/emergency-report/{id}', [EmergencyReportController::class, 'update'])
        ->name('EmergencyReport.update')
        ->middleware('auth:sanctum');
Route::delete('/emergency-report/{id}', [EmergencyReportController::class, 'delete'])
        ->name('EmergencyReport.delete')
        ->middleware('auth:sanctum');


Route::middleware(['role.access:Admin,1'])->as('api.')->group(function () {
    // route residential
    Route::get('/residential', [ResidentialController::class, 'dataTable'])->name('residential.dataTable');
    Route::post('/residential', [ResidentialController::class, 'store'])->name('residential.store');
    Route::get('/residential/{id}', [ResidentialController::class, 'show'])->name('residential.show');
    Route::put('/residential/{id}', [ResidentialController::class, 'update'])->name('residential.update');
    Route::delete('/residential/{id}', [ResidentialController::class, 'delete'])->name('residential.delete');

    // route residential block
    Route::get('/residential-block', [ResidentialBlockController::class, 'dataTable'])->name('residentialblock.dataTable');
    Route::post('/residential-block', [ResidentialBlockController::class, 'store'])->name('residentialblock.store');
    Route::get('/residential-block/{id}', [ResidentialBlockController::class, 'show'])->name('residentialblock.show');
    Route::put('/residential-block/{id}', [ResidentialBlockController::class, 'update'])->name('residentialblock.update');
    Route::delete('/residential-block/{id}', [ResidentialBlockController::class, 'delete'])->name('residentialblock.delete');

    // route history button
    // Route::get('/history-button', [HistoryButtonController::class, 'dataTable'])->name('history.dataTable');

    // route device
    Route::get('/device', [DeviceController::class, 'dataTable'])->name('device.dataTable');
    Route::post('/device', [DeviceController::class, 'store'])->name('device.store');
    Route::get('/device/{id}', [DeviceController::class, 'show'])->name('device.show');
    Route::put('/device/{id}', [DeviceController::class, 'update'])->name('device.update');
    Route::delete('/device/{id}', [DeviceController::class, 'delete'])->name('device.delete');

    // route device
    Route::get('/manage-user', [UserController::class, 'dataTable'])->name('user.dataTable');
    Route::post('/manage-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/manage-user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/manage-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/manage-user/{id}', [UserController::class, 'delete'])->name('user.delete');

});



