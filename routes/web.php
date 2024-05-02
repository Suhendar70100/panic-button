<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\HistoryButtonController;
use App\Http\Controllers\ResidentialBlockController;

Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route residential
    Route::get('/residential', [ResidentialController::class, 'index'])->name('residential.index');
    // route residential block
    Route::get('/residential-block', [ResidentialBlockController::class, 'index'])->name('residentialblock.index');
    // route hystory button
    Route::get('/history-button', [HistoryButtonController::class, 'index'])->name('history.index');

});

require __DIR__.'/auth.php';
