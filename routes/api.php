<?php

use Illuminate\Support\Facades\Route;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('test', function () {

    $data = [
        'name' => 'Gabriel',
    ];

    return view('new-doctor', $data);
});

Route::prefix('doctors')->group(function () {
    Route::get('', [\App\Http\Controllers\DoctorsController::class, 'index']);

    Route::post('', [\App\Http\Controllers\DoctorsController::class, 'create']);

    Route::post('login', [\App\Http\Controllers\DoctorsController::class, 'login']);
});
