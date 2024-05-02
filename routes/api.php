<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentialController;
use App\Http\Controllers\ResidentialBlockController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->as('api.')->group(function () {
    Route::get('/residential', [ResidentialController::class, 'dataTable'])->name('residential.dataTable');
    Route::post('/residential', [ResidentialController::class, 'store'])->name('residential.store');
    Route::get('/residential/{id}', [ResidentialController::class, 'show'])->name('residential.show');
    Route::put('/residential/{id}', [ResidentialController::class, 'update'])->name('residential.update');
    Route::delete('/residential/{id}', [ResidentialController::class, 'delete'])->name('residential.delete');

    // route residential block
    Route::get('/residential-block', [ResidentialBlockController::class, 'dataTable'])->name('residentialblock.dataTable');
    Route::post('/residential-block', [ResidentialBlockController::class, 'store'])->name('residentialblock.store');
    Route::get('/residential-block/{id}', [ResidentialBlockController::class, 'show'])->name('residentialblock.show');
    Route::put('/residential-block/{code_block}', [ResidentialBlockController::class, 'update'])->name('residentialblock.update');
    Route::delete('/residential-block/{id}', [ResidentialBlockController::class, 'delete'])->name('residentialblock.delete');
});



