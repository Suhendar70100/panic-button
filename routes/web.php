<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\ResidentialBlockController;

Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route residential
    Route::get('/residential', [ResidentialController::class, 'index'])->name('residential.index');
    Route::get('/residential-block', [ResidentialBlockController::class, 'index'])->name('residentialblock.index');

});

require __DIR__.'/auth.php';
