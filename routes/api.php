<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentialController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->as('api.')->group(function () {
    Route::get('/residential', [ResidentialController::class, 'dataTable'])->name('residential.dataTable');
    Route::post('/residential', [ResidentialController::class, 'store'])->name('residential.store');
    Route::get('/residential/{id}', [ResidentialController::class, 'show'])->name('residential.show');
    Route::put('/residential/{id}', [ResidentialController::class, 'update'])->name('residential.update');
    Route::delete('/residential/{id}', [ResidentialController::class, 'delete'])->name('residential.delete');
});


