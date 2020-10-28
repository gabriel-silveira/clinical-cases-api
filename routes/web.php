<?php

use Illuminate\Support\Facades\Route;

Route::prefix('doctors')->group(function () {
    Route::get('', [\App\Http\Controllers\DoctorsController::class, 'index']);

    Route::post('', [\App\Http\Controllers\DoctorsController::class, 'create']);

    Route::post('login', [\App\Http\Controllers\DoctorsController::class, 'login']);
});
