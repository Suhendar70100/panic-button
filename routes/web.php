<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentialController;

Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route residential
    Route::get('/residential', [ResidentialController::class, 'index'])->name('residential.index');
});

require __DIR__.'/auth.php';
