<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\HistoryButtonController;
use App\Http\Controllers\ResidentialBlockController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceActivityController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route device activity
    Route::get('/device-activity', [DeviceActivityController::class, 'index'])->name('deviceActivity.index');
});

Route::middleware(['role.access:Admin,1'])->group(function () {
    // route residential
    Route::get('/residential', [ResidentialController::class, 'index'])->name('residential.index');
    // route residential block
    Route::get('/residential-block', [ResidentialBlockController::class, 'index'])->name('residentialblock.index');
    // route hystory button
    // Route::get('/history-button', [HistoryButtonController::class, 'index'])->name('history.index');
    // Route device
    Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
    // route user
    Route::get('/manage-user', [UserController::class, 'index'])->name('user.index');

});

require __DIR__.'/auth.php';
